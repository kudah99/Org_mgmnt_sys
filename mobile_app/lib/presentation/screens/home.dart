import 'package:flutter/material.dart' as MT;
import 'package:fluent_ui/fluent_ui.dart';
import 'package:mobile_app/constants/constants.dart';
import 'package:mobile_app/data/models/members.dart';
import 'package:mobile_app/data/repositories/members.dart';
import 'package:mobile_app/presentation/screens/member_contrib_details.dart';

class MyHomePage extends StatefulWidget {
  const MyHomePage({super.key, required this.title});

  final String title;

  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  List<Member> selectedMembers = [];
  RemoteMembersRepository _remoteMembersRepository =
      RemoteMembersRepository(baseUrl);

  @override
  void initState() {
    final data = _remoteMembersRepository.getAllMembers();

    data.then((value) => print(value));
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    //super.build(context);
    final theme = FluentTheme.of(context);
    return MT.Scaffold(
        appBar: MT.AppBar(
          title: Text(widget.title),
        ),
        body: SafeArea(
            child: Center(
                child: Container(
                    margin: EdgeInsets.fromLTRB(
                        10, MediaQuery.of(context).size.height * .10, 10, 0),
                    decoration: BoxDecoration(
                      color: theme.resources.cardBackgroundFillColorDefault,
                      borderRadius: BorderRadius.circular(8.0),
                      border: Border.all(
                        color: theme.resources.controlStrokeColorSecondary,
                      ),
                    ),
                    child: ClipRRect(
                        borderRadius: BorderRadius.circular(8.0),
                        child: Column(children: [
                          Expander(
                              icon: Icon(MT.Icons.people),
                              contentBackgroundColor: Colors.transparent,
                              initiallyExpanded: true,
                              header: Text("Organisations members"),
                              content: FutureBuilder(
                                  future:
                                      _remoteMembersRepository.getAllMembers(),
                                  builder: (BuildContext context, snapshot) {
                                    // Loading data
                                    if (snapshot.connectionState ==
                                        ConnectionState.waiting) {
                                      return const Center(
                                        child: ProgressRing(),
                                      );
                                    }
                                    if (snapshot.connectionState ==
                                        ConnectionState.done) {
                                      if (snapshot.hasError) {
                                        return Center(
                                          child: Text(
                                            'An ${snapshot.error} occurred',
                                            style: TextStyle(
                                                fontSize: 18,
                                                color: Colors.red),
                                          ),
                                        );
                                      } else if (snapshot.hasData) {
                                        final data = snapshot.data;
                                        return list_view(data);
                                      }
                                    }

                                    return const Center(
                                      child: ProgressRing(),
                                    );
                                    //
                                  }))
                        ]))))));
  }

  Widget list_view(List<Member>? member) {
    return ListView.builder(
        shrinkWrap: true,
        itemCount: member!.length,
        itemBuilder: (context, index) {
          final contact = member[index];
          return ListTile.selectable(
            leading: CircleAvatar(
              child: Icon(MT.Icons.person),
            ),
            title: Text('${member[index].firstName} ${member[index].lastName}'),
            subtitle: Text(member[index].email),
            trailing: Button(
                child: Text("view"),
                onPressed: () {
                  Navigator.push(
                      context,
                      MT.MaterialPageRoute(
                          builder: (context) => MemberContribDetails(
                                member: member[index],
                                member_id: member[index].id ?? 1,
                              )));
                }),
            selected: selectedMembers.contains(contact),
            selectionMode: ListTileSelectionMode.multiple,
            onSelectionChange: (selected) {
              setState(() {
                if (selected) {
                  selectedMembers.add(contact);
                } else {
                  selectedMembers.remove(contact);
                }
              });
            },
          );
        });
  }

  void showContentDialog(BuildContext context) async {
    final result = await showDialog<String>(
      context: context,
      builder: (context) => ContentDialog(
        title: const Text('Delete file permanently?'),
        content: const Text(
          'If you delete this file, you won\'t be able to recover it. Do you want to delete it?',
        ),
        actions: [
          Button(
            child: const Text('Delete'),
            onPressed: () {
              Navigator.pop(context, 'User deleted file');
              // Delete file here
            },
          ),
          FilledButton(
            child: const Text('Cancel'),
            onPressed: () => Navigator.pop(context, 'User canceled dialog'),
          ),
        ],
      ),
    );
    setState(() {});
  }
}

import 'package:flutter/material.dart' as MT;
import 'package:fluent_ui/fluent_ui.dart';
import 'package:mobile_app/constants/constants.dart';
import 'package:mobile_app/data/models/member_contrib.dart';
import 'package:mobile_app/data/models/members.dart';
import 'package:mobile_app/data/repositories/member_contrib.dart';
import 'package:mobile_app/presentation/widgets/form.dart';

class MemberContribDetails extends StatefulWidget {
  final Member? member;
  final int member_id;
  const MemberContribDetails(
      {super.key, required this.member, required this.member_id});

  @override
  State<MemberContribDetails> createState() => _MemberContribDetailsState();
}

class _MemberContribDetailsState extends State<MemberContribDetails> {
  List<MemberContrib> selectedMembersContrib = [];

  final RemoteMembersContribRepository _membersContribRepository =
      RemoteMembersContribRepository(baseUrl);

  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    final theme = FluentTheme.of(context);
    return MT.Scaffold(
      appBar: MT.AppBar(
        title: Text("Member contribution"),
        centerTitle: true,
      ),
      body: SafeArea(
          child: Column(
        children: [
          SizedBox(
            height: 20,
          ),
          Container(
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
                      icon: Icon(MT.Icons.person_2),
                      contentBackgroundColor: Colors.transparent,
                      initiallyExpanded: true,
                      header: Text("Member"),
                      content: ListView(
                        shrinkWrap: true,
                        children: [
                          ListTile(
                            title: Text("Name:"),
                            subtitle: Text(widget.member!.firstName +
                                widget.member!.lastName),
                          ),
                          ListTile(
                            title: Text("Email:"),
                            subtitle: Text(widget.member!.email),
                          ),
                          ListTile(
                            title: Text("Phone number:"),
                            subtitle: Text(widget.member!.phoneNumber),
                          ),
                          ListTile(
                            title: Text("Gender:"),
                            subtitle:
                                Text(widget.member?.gender ?? 'Not provided'),
                          ),
                        ],
                      ),
                    )
                  ]))),
          Container(
              margin: EdgeInsets.fromLTRB(10, 10, 10, 0),
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
                        icon: Icon(MT.Icons.receipt),
                        contentBackgroundColor: Colors.transparent,
                        initiallyExpanded: true,
                        header: Row(
                          children: [
                            Text("Financial Contributions"),
                            IconButton(
                                icon: Icon(MT.Icons.edit),
                                onPressed: () {
                                  showContentDialog(context);
                                })
                          ],
                        ),
                        content: FutureBuilder(
                            future: _membersContribRepository
                                .getMemberContribById(widget.member_id),
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
                                          fontSize: 18, color: Colors.red),
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
                  ])))
        ],
      )),
    );
  }

  Widget list_view(MemberContrib? memberContrib) {
    return ListView(
      shrinkWrap: true,
      children: [
        ListTile(
            title: Text("Total Contribution:"),
            subtitle: Text("${memberContrib!.amount} USD")),
        ListTile(
            title: Text("Member Package:"),
            subtitle: Text(memberContrib.package))
      ],
    );
  }

  void showContentDialog(BuildContext context) async {
    final result = await showDialog<String>(
      context: context,
      builder: (context) => ContentDialog(
          content: MemberContributionForm(
        member_id: widget.member_id,
      )),
    );
    setState(() {});
  }
}

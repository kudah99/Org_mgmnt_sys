import 'package:flutter/material.dart';
import 'package:mobile_app/constants/constants.dart';
import 'package:mobile_app/data/models/member_contrib.dart';
import 'package:mobile_app/data/repositories/member_contrib.dart';

class MemberContributionForm extends StatefulWidget {
  const MemberContributionForm({super.key, required this.member_id});
  final int member_id;

  @override
  State<MemberContributionForm> createState() => _MemberContributionFormState();
}

class _MemberContributionFormState extends State<MemberContributionForm> {
  final _memberIdController =
      TextEditingController(); // Pre-fill with actual member ID
  final _amountController = TextEditingController();
  final _packageController =
      TextEditingController(); // Store selected package value

  MemberContrib _memberContrib = MemberContrib(
    memberId: 123, // Replace with actual member ID
    amount: '0.0',
    package: '',
  ); // Initialize with existing data

  void _onAmountChanged(String value) {
    _memberContrib = _memberContrib.copyWith(amount: value);
  }

  void _onPackageSelected(String value) {
    _memberContrib = _memberContrib.copyWith(package: value);
  }

  Future<void> _onSubmitPressed() async {
    // Update member contribution
    final response = await RemoteMembersContribRepository(baseUrl)
        .updateMemberContrib(_memberContrib, widget.member_id);

    print(response);
  }

  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('Update Member Contribution')),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          children: [
            TextField(
              controller: _memberIdController,
              enabled: false, // Pre-filled, non-editable
              decoration:
                  InputDecoration(labelText: 'Member ID:  ${widget.member_id}'),
            ),
            const SizedBox(height: 10.0),
            TextField(
              controller: _amountController,
              keyboardType: TextInputType.number,
              decoration: InputDecoration(labelText: 'Amount'),
              onChanged: _onAmountChanged,
            ),
            const SizedBox(height: 10.0),
            TextField(
              controller: _packageController,
              keyboardType: TextInputType.text,
              decoration: InputDecoration(labelText: 'Package'),
              onChanged: _onPackageSelected,
            ),
            const SizedBox(height: 20.0),
            FilledButton(
              onPressed: _onSubmitPressed,
              child: Text('Update Contribution'),
            ),
          ],
        ),
      ),
    );
  }
}

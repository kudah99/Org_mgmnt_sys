// Base class for data access
import 'package:mobile_app/data/models/members.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;

abstract class MembersRepository {
  Future<List<Member>> getAllMembers();
}

class RemoteMembersRepository implements MembersRepository {
  final String baseUrl;

  RemoteMembersRepository(this.baseUrl);

  @override
  Future<List<Member>> getAllMembers() async {
    final response = await http.get(Uri.parse('$baseUrl/api/v1/members'));

    if (response.statusCode == 200) {
      final Map<String, dynamic> jsonData = json.decode(response.body);
      final memberList = jsonData['data'] as List<dynamic>;

      return memberList.map((member) => Member.fromJson(member)).toList();
    } else {
      throw Exception('Failed to load members');
    }
  }
}

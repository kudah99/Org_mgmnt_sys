// Base class for data access
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:mobile_app/data/models/member_contrib.dart';

abstract class MembersContribRepository {
  Future<MemberContrib> getMemberContribById(int memberId);
}

class RemoteMembersContribRepository implements MembersContribRepository {
  final String baseUrl;

  RemoteMembersContribRepository(this.baseUrl);

  @override
  Future<MemberContrib> getMemberContribById(int memberId) async {
    final url = Uri.parse('$baseUrl/api/v1/members_contribution/$memberId');
    final response = await http.get(url);

    if (response.statusCode == 200) {
      final jsonData = jsonDecode(response.body) as Map<String, dynamic>;
      return MemberContrib.fromJson(jsonData['data']);
    } else {
      throw Exception('Failed to fetch member contribution');
    }
  }

  Future<dynamic> updateMemberContrib(
      MemberContrib memberContrib, int memberId) async {
    final url = Uri.parse('$baseUrl/api/v1/members_contribution/$memberId');
    final response =
        await http.put(url, body: jsonEncode(memberContrib.toJson()));

    if (response.statusCode == 200) {
      //print(response.body);
      return response.body;
    } else {
      throw Exception('Failed to update member contribution');
    }
  }
}

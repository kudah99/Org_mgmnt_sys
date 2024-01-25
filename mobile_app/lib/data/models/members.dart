class Members {
  final List<Member> data;

  const Members({required this.data});

  factory Members.fromJson(Map<String, dynamic> json) {
    final memberList = json['data'] as List<dynamic>;
    return Members(
        data: memberList.map((member) => Member.fromJson(member)).toList());
  }
}

class Member {
  final int? id;
  final String firstName;
  final String lastName;
  final String email;
  final String phoneNumber;
  final String? birthDate; // nullable since it's null in the provided data
  final String address;
  final String gender;
  final DateTime? createdAt;
  final DateTime? updatedAt;

  const Member({
    this.id,
    required this.firstName,
    required this.lastName,
    required this.email,
    required this.phoneNumber,
    this.birthDate,
    required this.address,
    required this.gender,
    this.createdAt,
    this.updatedAt,
  });

  factory Member.fromJson(Map<String, dynamic> json) => Member(
        id: json['id'] as int,
        firstName: json['first_name'] as String,
        lastName: json['last_name'] as String,
        email: json['email'] as String,
        phoneNumber: json['phone_number'] as String,
        birthDate: json['birth_date'] as String?, // handle null value
        address: json['address'] as String,
        gender: json['gender'] as String,
        createdAt: DateTime.parse(json['created_at'] as String),
        updatedAt: DateTime.parse(json['updated_at'] as String),
      );
}

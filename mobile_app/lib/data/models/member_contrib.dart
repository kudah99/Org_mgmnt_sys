class MemberContrib {
  final int memberId;
  final String amount;
  final String package;

  MemberContrib({
    required this.memberId,
    required this.amount,
    required this.package,
  });

  factory MemberContrib.fromJson(Map<String, dynamic> json) {
    return MemberContrib(
      memberId: json['member_id'] as int,
      amount: json['amount'] as String,
      package: json['package'] as String,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'member_id': memberId,
      'amount': amount,
      'package': package,
    };
  }

  MemberContrib copyWith({
    int? memberId,
    String? amount,
    String? package,
  }) {
    return MemberContrib(
      memberId: memberId ?? this.memberId,
      amount: amount ?? this.amount,
      package: package ?? this.package,
    );
  }
}

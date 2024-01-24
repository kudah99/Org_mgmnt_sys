<?php

namespace App\Http\Controllers\MemberContribution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberContribution;
class MemberContributionController extends Controller
{
    public function view_index(Request $request)
    {
        $member_contributions = MemberContribution::all();
        return view('members.index', compact('member_contributions'));
    }

        /**
     * Store a newly created contribution in the database.
     *
     * @param  \Illuminate\Http\Request  $request

     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'package' => 'nullable|string',
        ]);

        // Create a new contribution record
        $contribution = new MemberContribution();
        $contribution -> member_id = $request->input('member_id');
        $contribution -> amount = $request->input('amount');
        $contribution -> package = $request->input('package');
        $contribution -> save();

        // Redirect back or return a response
        return redirect()->back()->with('success', 'Contribution stored successfully');
    }
}

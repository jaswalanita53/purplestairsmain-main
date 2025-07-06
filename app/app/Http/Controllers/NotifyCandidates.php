<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Delete;

class NotifyCandidates extends Controller
{
    public function send_notification(){
        $users = User::where('user_type', 'candidate')->where('status', 1)->whereNull('deleted_at')->get();
        // ->where('email','eptdevs2017@gmail.com')

        // dd($users);
        $todays_date = date('Y-m-d');
        foreach ($users as $user) {
            $user_notified = \DB::table('candidates_notifications')->where('user_id', $user->id)->first();

            $update_next_execution = 0;
            if ($user_notified) {
                
                if ($user_notified->notification_response != 'sleep') {
                    $last_execution = $user_notified->last_execution_date;

                    if ($user_notified->notification_response == '') {
                        $next_reminder_date = date('Y-m-d', strtotime( $last_execution . " +14 day")); // live - 2 weeks
                        // $next_reminder_date = date('Y-m-d', strtotime( $last_execution . " +2 minutes")); // testing - 2 minutes
                    } else {
                        $next_reminder_date = $user_notified->next_execution_date;
                        $update_next_execution = 1;
                    }

                    if ($todays_date == $next_reminder_date) {
                        $this->send_email($user);

                        $updates = ['last_execution_date' => $todays_date, 'notification_response' => null];
                        if ($update_next_execution == 1) {
                            $updates['next_execution_date'] = date('Y-m-d', strtotime( $todays_date . " +3 months")); // live - 3 months
                            // $updates['next_execution_date'] = date('Y-m-d', strtotime( $todays_date . " +3 minutes")); // testing - 3 minutes
                        }

                        \DB::table('candidates_notifications')
                          ->where('id', $user_notified->id)
                          ->update($updates);
                    }
                }
            } else {
                /* task - 86a1ju9cn $this->send_email($user);

                \DB::table('candidates_notifications')->insert([
                    'user_id' => $user->id,
                    'last_execution_date' => $todays_date
                ]);*/

                $next_reminder_date = date('Y-m-d', strtotime( $user->created_at . " +14 day"));

                if ($todays_date == $next_reminder_date) {
                    $this->send_email($user);

                    $updates = ['last_execution_date' => $todays_date, 'notification_response' => null];
                    // if ($update_next_execution == 1) {
                    $updates['next_execution_date'] = date('Y-m-d', strtotime( $todays_date . " +3 months")); // live - 3 months
                    // $updates['next_execution_date'] = date('Y-m-d', strtotime( $todays_date . " +3 minutes")); // testing - 3 minutes
                    // }

                    \DB::table('candidates_notifications')
                      ->where('id', $user_notified->id)
                      ->update($updates);
                }
            }
        }
    }

    public function send_email($user)
    {
        $name = explode(' ', trim($user->name)); // task - 86a15vje7
        $data = array('name' => $name[0]/*user->name*/, 'id' => $user->id);
        $to_mail = $user->email;

        \Mail::send(['html'=>'mail.notify_candidate'], $data, function($message) use ($to_mail) {
             $message->to($to_mail, 'Purple Stairs')->subject
                ('Are you still open to new opportunities?');
             $message->from('info@purplestairs.com','Purple Stairs');
        });
    }

    public function sleep_account($id)
    {
        // $user = User::find($id);
        $user = \DB::table('users')->where('id', $id)->first();
        $user_notified = \DB::table('candidates_notifications')->where('user_id', $user->id)->first();

        if ($user_notified->notification_response != '') {
            return redirect()->route('login');
        }
        return view('pages.sleepaccountbycron', compact('user'));
    }

    public function sleep_my_account(Request $request)
    {   
        $input = $request->all();
        $user = User::find($input['user_id']);

        $todays_date = date('Y-m-d');
        if($user->password != '')
        {
            if (Hash::check($input['password'], $user->password)) {
                Delete::create([
                    'reason' => $input['reason'],
                    'other'  => isset($input['other']) ? $input['other'] : null,
                    'user_id' => $user->id,
                    'type' => 'sleep'
                ]);
                // The passwords match...

                \DB::table('candidates_notifications')
                ->where('user_id', $user->id)
                ->update(['notification_response' => 'sleep', 'next_execution_date' => date('Y-m-d', strtotime( $todays_date . " +3 months"))]);
                $user->delete();
                return redirect()->route('login');
            }
            else{
                session()->flash('errors', 'Invalid password.');
                return redirect('/notify/candidate/sleep/'.$user->id);
            }
        }
        else{
            \DB::table('candidates_notifications')
                ->where('user_id', $user->id)
                ->update(['notification_response' => 'sleep', 'next_execution_date' => date('Y-m-d', strtotime( $todays_date . " +3 months"))]);

            Delete::create([
                'reason' => $input['reason'],
                'other'  => isset($input['other']) ? $input['other'] : null,
                'user_id' => $user->id,
                'type' => 'sleep'
            ]);
            // The passwords match...
            $user->delete();
            return redirect()->route('login');
        }
    }

    public function keep_active($id)
    {
        // $user = User::find($id);
        $user = \DB::table('users')->where('id', $id)->first();
        $user_notified = \DB::table('candidates_notifications')->where('user_id', $user->id)->first();

        if ($user_notified->notification_response != '') {
            return redirect()->route('login');
        }

        return view('pages.keepactivebycron', compact('user'));
    }

    public function keep_my_account_active(Request $request)
    {
        $input = $request->all();
        // $user = User::find($input['user_id']);
        $user = \DB::table('users')->where('id', $input['user_id'])->first();
        $todays_date = date('Y-m-d');
        if ($user) {
            \DB::table('candidates_notifications')
                ->where('user_id', $user->id)
                ->update(['notification_response' => 'active', 'next_execution_date' => date('Y-m-d', strtotime( $todays_date . " +3 months"))]);
        } else {
            session()->flash('errors', 'Invalid user.');
        }
        return redirect()->route('login');
    }
}

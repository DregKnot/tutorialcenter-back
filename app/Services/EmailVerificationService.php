<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\EmailVerification;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\StudentEmailVerification;

class EmailVerificationService
{
    public function send(Model $user): void
    {
        // Remove existing tokens
        EmailVerification::where('verifiable_type', get_class($user))
            ->where('verifiable_id', $user->id)
            ->delete();

        $token = Str::uuid();

        EmailVerification::create([
            'verifiable_type' => get_class($user),
            'verifiable_id' => $user->id,
            'token' => $token,
            'expires_at' => now()->addMinutes(30),
        ]);

        $user->notify(new StudentEmailVerification($token));
    }
}


// namespace App\Services;

// use Illuminate\Support\Str;
// use App\Models\EmailVerification;
// use Illuminate\Support\Facades\DB;
// use App\Notifications\StudentEmailVerification;

// class EmailVerificationService
// {
//     public function send($student): bool
//     {
//         return DB::transaction(function () use ($student) {

//             $token = Str::uuid();

//             EmailVerification::create([
//                 'student' => $student->id,
//                 'token' => $token,
//                 'expires_at' => now()->addMinutes(30),
//             ]);

//             $student->notify(new StudentEmailVerification($token));

//             return true;
//         });
//     }
// }

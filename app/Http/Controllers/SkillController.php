<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function userSkills($user_id){
        $skills = Skill::where('user_id', $user_id)->where('status', 1)->orderBy('score', 'DESC')->get();

        return response()->json($skills, 200);
    }
}

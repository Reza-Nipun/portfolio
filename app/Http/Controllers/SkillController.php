<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getUserWiseSkills(Request $request)
    {
        $user_id = Auth::user()->id;
        
        $sort = $request->sort ?? 'score';
        $order = $request->order ?? 'DESC';
        $limit  = $request->limit ?? 10;

        $skills = Skill::where('user_id', $user_id)->orderBy($sort, $order)->paginate($limit);

        return response()->json($skills, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getSkillById(Request $request)
    {
        $skill_id = $request->route('id');

        $skill = SKill::find($skill_id);

        if (!$skill) {
            return response()->json(["message" => "Skill not found!"], 404);
        }

        return response()->json($skill, 200);
    }

    /**
     * @param $id
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function updateSkill($id, Request $request)
    {
        $skill = Skill::find($id);
        $skill->skill = $request->skill ?? $skill->skill;
        $skill->score = $request->score ?? $skill->score;
        $skill->status = $request->status ?? $skill->status;
        $skill->save();

        return response()->json('Skill updated!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    /**
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function userPortfolios($user_id)
    {
        $portfolios = Portfolio::where('user_id', $user_id)
                ->orderBy('id', 'DESC')
                ->get();

        return response()->json($portfolios, 200);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getUserWisePortfolios(Request $request)
    {
        $user_id = Auth::user()->id;
        
        $sort = $request->sort ?? 'id';
        $order = $request->order ?? 'DESC';
        $limit  = $request->limit ?? 10;
        
        $portfolios = Portfolio::where('user_id', $user_id)
                        ->orderBy($sort, $order)
                        ->paginate($limit);

        return response()->json($portfolios, 200);
    }
}

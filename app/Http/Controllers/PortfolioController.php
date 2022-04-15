<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

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
}

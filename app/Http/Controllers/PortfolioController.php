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

    /**
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function getPortfolioById(Request $request)
    {
        $portfolio_id = $request->route('id');
        
        $portfolio = Portfolio::find($portfolio_id);

        if(!$portfolio) {
            return response()->json(['message' => 'Portfolio not found!']);
        }

        return response()->json($portfolio, 200);
    }

    public function updatePortfolio($id, Request $request)
    {
        $this->validate($request, [
            'project_title' => 'required|max:255',
            'project_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $portfolio = Portfolio::find($id);
        $portfolio->project_title = $request->project_title ?? $portfolio->project_title;
        $portfolio->developed_for = $request->developed_for;
        $portfolio->project_url = $request->project_url;
        $portfolio->description = $request->description;
        $portfolio->status = $request->status ?? $portfolio->status;

        if($request->file('project_image')){
            if(!empty($portfolio->project_image)){
                unlink(public_path($portfolio->project_image));
            }

            $file= $request->file('project_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/img/portfolios/'), $filename);
            $portfolio->project_image = 'assets/img/portfolios/'.$filename;
        }

        $portfolio->save();

        return response()->json('Portfolio updated!');
    }
}

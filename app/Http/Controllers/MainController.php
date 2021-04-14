<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Dannie;
use Illuminate\Http\Request;

class MainController extends Controller {

    public function home() {
        return view('home');
    }

    public function naselenie() {
        $naselenie_ = new Dannie();
        $naselenie_ = Dannie::orderBy('kol', 'DESC')->get();
        
        $pdo = DB::connection()->getPdo();
        $ratingKol = [];
        $ratingDohod = [];
        $ratingRashod = [];
        $sql = "CALL GetRatingKol()";
        $sql1 = "CALL GetRatingDohod()";
        $sql2 = "CALL GetRatingRashod()";

        $query = $pdo->query($sql);

        $rateKol = $query->fetchAll();
        foreach($rateKol as $item)
            $ratingKol[$item['id']] = $item['position'];
        $query->closeCursor();

        $query1 = $pdo->query($sql1);
        $rateDohod = $query1->fetchAll();
        foreach($rateDohod as $item)
            $ratingDohod[$item['id']] = $item['position'];
        $query1->closeCursor();

        $query2 = $pdo->query($sql2);
        $rateRashod = $query2->fetchAll();
        foreach($rateRashod as $item)
            $ratingRashod[$item['id']] = $item['position'];
        $query2->closeCursor();
            /*do {
            $rowset = $query->fetch();
            if ($rowset)
                $ratingKol[$rowset['id']] = $rowset['position'];
        } while ($query->nextRowset());

        do {
            $rowset = $query1->fetch();
            if ($rowset)
                $ratingDohod[$rowset[0]] = $rowset[1];
        } while ($query1->nextRowset());
        
        do {
            $rowset = $query2->fetch();
            if ($rowset)
                $ratingRashod[$rowset[0]] = $rowset[1];
        } while ($query2->nextRowset());*/

        return view('naselenie', ['naselenie_' => $naselenie_->all(), 'ratingKol' => $ratingKol, 'ratingDohod' => $ratingDohod, 'ratingRashod' => $ratingRashod]);
    }

    public function naselenie_check(Request $request) {
        $valid = $request->validate([
            'city' => 'required|min:1|max:100',
            'dohod' => 'required|min:1|max:100',
            'rashod' => 'required|min:1|max:100',
            'kol' => 'required|min:1|max:100'
        ]);

        $naselenie = new Dannie();
        $naselenie->city = $request->input('city');
        $naselenie->dohod = $request->input('dohod');
        $naselenie->rashod = $request->input('rashod');
        $naselenie->kol = $request->input('kol');
        $naselenie->save();

        return redirect()->route('naselenie');
    }
}
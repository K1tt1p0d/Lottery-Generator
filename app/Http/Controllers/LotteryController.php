<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LotteryController extends Controller
{
    public function index() 
    {
        return view('lottery');
    }

    public function generate() 
    {
        $first_prize = rand(0,999);
        $first_prize = sprintf("%03d", $first_prize);

        $second_prize_st = rand(0,999);
        $second_prize_st = sprintf("%03d", $second_prize_st);

        $second_prize_nd = rand(0,999);
        $second_prize_nd = sprintf("%03d", $second_prize_nd);

        $second_prize_rd = rand(0,999);
        $second_prize_rd = sprintf("%03d", $second_prize_rd);

        $similar_first_prize_more = $first_prize + 1;
        $similar_first_prize_more = sprintf("%03d", $similar_first_prize_more);

        $similar_first_prize_less = $first_prize - 1;
        $similar_first_prize_less = sprintf("%03d", $similar_first_prize_less);

        $two_digit_prize = rand(0,99);
        $two_digit_prize = sprintf("%02d", $two_digit_prize);

        setcookie('first_prize', $first_prize, time() + (86400 * 30), "/");
        setcookie('second_prize_st', $second_prize_st, time() + (86400 * 30), "/");
        setcookie('second_prize_nd', $second_prize_nd, time() + (86400 * 30), "/");
        setcookie('second_prize_rd', $second_prize_rd, time() + (86400 * 30), "/");
        setcookie('similar_first_prize_more', $similar_first_prize_more, time() + (86400 * 30), "/");
        setcookie('similar_first_prize_less', $similar_first_prize_less, time() + (86400 * 30), "/");
        setcookie('two_digit_prize', $two_digit_prize, time() + (86400 * 30), "/");

        $data = compact('first_prize', 'second_prize_st', 'second_prize_nd', 'second_prize_rd', 'similar_first_prize_more', 'similar_first_prize_less', 'two_digit_prize');
        return $data;
    }

    public function submit(Request $request) 
    {
        $first_prize = strval($request->first_prize);
        $second_prize_st = strval($request->second_prize_st);
        $second_prize_nd = strval($request->second_prize_nd);
        $second_prize_rd = strval($request->second_prize_rd);
        $similar_first_prize_more = strval($request->similar_first_prize_more);
        $similar_first_prize_less = strval($request->similar_first_prize_less);
        $two_digit_prize = strval($request->two_digit_prize);
        $check_prize = strval($request->check_prize);
        $message = $check_prize;
        $result = "success";
        $title = "Congratulations";
        if($first_prize == $check_prize) $message .= " ถูกรางวัลที่ 1";
        elseif($second_prize_st == $check_prize || $second_prize_nd == $check_prize || $second_prize_rd == $check_prize) $message .= " ถูกรางวัลที่ 2";
        elseif($similar_first_prize_more == $check_prize || $similar_first_prize_less == $check_prize) $message .= " ถูกรางวัลเลขข้างเคียงรางวัลที่ 1";

        $check_prize = substr($check_prize,1);
        if($two_digit_prize == $check_prize){
            if(strlen($message) > 3) $message .= " และ";
            else $message .= " ถูก";
            $message .= "รางวัลเลขท้าย 2 ตัว";
        }
        if(strlen($message) <= 3){
            $message .= " ไม่ถูกรางวัลใดเลย";
            $result = "error";
            $title = "Condolence";
        };
        return compact('title', 'message','result');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductManagement\Category;
use App\Models\ProductManagement\Product;
use App\Models\TagManagement\Tag;
use App\Models\TransactionManagement\ProductTransaction;
use App\Models\TransactionManagement\Transaction;
use Carbon\Carbon;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // TAG
        $tags_name = Tag::all()->pluck('name');
        $tags = Tag::all();
        $tag_array = [];
        $t = 0;
        foreach ($tags as $key => $tag) {
            $amount = 0;
            $product_ids = $tag->hasProduct->pluck('id');
            foreach ($product_ids as $key => $pid) {
                if (ProductTransaction::where('product_id', $pid)->pluck('transaction_id')->count() > 0) {
                    $amount += ProductTransaction::where('product_id', $pid)->first()->quantity;
                } else {
                    $amount += 0;
                }
            }
            $tag_array[$t++] = $amount;
        }
        $tagData = json_encode($tag_array);

        // CATEGORY
        $categories_name = Category::all()->pluck('name');
        $categories = Category::all();
        $category_array = [];
        $c = 0;
        foreach ($categories as $key => $category) {
            $amount = 0;
            $product_ids = $category->hasProduct->pluck('id');
            foreach ($product_ids as $key => $pid) {
                if (ProductTransaction::where('product_id', $pid)->pluck('transaction_id')->count() > 0) {
                    $amount += ProductTransaction::where('product_id', $pid)->first()->quantity;
                } else {
                    $amount += 0;
                }
            }
            $category_array[$c++] = $amount;
        }
        $categoryData = json_encode($category_array);

        // TOTAL profit
        // 1 => vending
        $VP_profit = [];
        $s = 0;
        for ($i = 1; $i <= 12; $i++) {
            if ($i < 10) {
                $d = '0' . $i;
            } else {
                $d = $i;
            }
            $date_START = '2020' . $d . '01';
            $date_END = '2020' . $d . '31';
            $vending = ProductTransaction::where('shop_type', 1)->whereBetween('created_at', [$date_START, $date_END])->pluck('transaction_id');
            $vending_profit = 0;
            if ($vending->count() > 0) {
                foreach ($vending as $tid) {
                    $vending_profit += Transaction::all()->where('id', $tid)->first()->amount;
                }
            }
            $VP_profit[$s++] = $vending_profit;
        }
        $VP_profit_data = json_encode($VP_profit);
        //  2 => windowshop
        $WSP_profit = [];
        $s = 0;
        for ($i = 1; $i <= 12; $i++) {
            if ($i < 10) {
                $d = '0' . $i;
            } else {
                $d = $i;
            }
            $date_START = '2020' . $d . '01';
            $date_END = '2020' . $d . '31';
            $windowshop = ProductTransaction::where('shop_type', 2)->whereBetween('created_at', [$date_START, $date_END])->pluck('transaction_id');
            $windowshop_profit = 0;
            if ($windowshop->count() > 0) {
                foreach ($windowshop as $tid) {
                    $windowshop_profit += Transaction::all()->where('id', $tid)->first()->amount;
                }
            }
            $WSP_profit[$s++] = $windowshop_profit;
        }
        $WSP_profit_data = json_encode($WSP_profit);

        return view('_layout.dashboard', compact('tags_name', 'tagData', 'categories_name', 'categoryData', 'VP_profit_data', 'WSP_profit_data'));
    }


    public function git_pull()
    {
        $path_project = '/home/one92/project_pool/ive_tm_fyp_smart_shop';
        $path_script = '/resources/scripts/deploy.sh';

        if (!is_dir($path_project)) {
            session()->flash('fail', 'Error: Not found the directory location of the server.');
            return redirect()->back();
        } elseif (!file_exists($path_project . $path_script)) {
            session()->flash('fail', 'Error: Not found the Shell file location of the server.');
            return redirect()->back();
        }

        $process = new Process("(cd $path_project; sh $path_project" . "$path_script) ");
        $process->setWorkingDirectory('/home/one92/project_pool/ive_tm_fyp_smart_shop');
        $process->run();

        //executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();

        session()->flash('message', $output);
        return redirect()->back();
    }


    public function reset_multichain()
    {
        $process = new Process("sshpass -p 'Qwe!23' ssh -f ss-mc-01@192.168.15.176 -p 2222 '~/reset.sh && exit'");
        $process->run();

        //executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();

        session()->flash('message', $output);
        return redirect()->back();
    }

    public function migrate()
    {
        $path_project = '/home/one92/project_pool/ive_tm_fyp_smart_shop';
        $path_script = '/resources/scripts/migrate.sh';

        if (!is_dir($path_project)) {
            session()->flash('fail', 'Error: Not found the directory location of the server.');
            return redirect()->back();
        } elseif (!file_exists($path_project . $path_script)) {
            session()->flash('fail', 'Error: Not found the Shell file location of the server.');
            return redirect()->back();
        }

        $process = new Process("(cd $path_project; sh $path_project" . "$path_script) ");
        $process->setWorkingDirectory('/home/one92/project_pool/ive_tm_fyp_smart_shop');
        $process->run();

        //executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();

        session()->flash('message', $output);
        return redirect()->back();
    }
}

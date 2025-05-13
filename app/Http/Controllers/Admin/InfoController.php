<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserBan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    public function index()
    {
        $serverData = $this->data('server');
        $siteData = $this->data('site');

        return view('admin.info')->with([
            'siteData' => $siteData,
            'serverData' => $serverData
        ]);
    }

public function data($type)
{
    switch ($type) {
        case 'site':
            $totalUsers = User::count(); // Total Users (Simple, but JP's dumbass won't understand LOL)
            $totalThreads = DB::table('forum_threads')->count(); // Same as the user count, just count threads
            $totalReplies = DB::table('forum_replies')->count(); // Ditto
            $totalGames = DB::table('games')->count(); // Ditto
            $totalItems = DB::table('items')->count(); // Ditto
            $totalStaff = DB::table('staff_users')->count(); // Ditto
            $totaltf = $totalThreads + $totalReplies; // Combines the threads and replies for the toal of both
            $joinedToday = User::where('created_at', '>=', Carbon::now()->subDays(1))->count(); // Checks the users table, created_at row for anyone joined under a day
            $onlineUsers = User::where('updated_at', '>=', Carbon::now()->subMinutes(3))->count(); // Checks updated_at if under 3 minutes that person is on, add all!
            $bannedUsers = UserBan::where('active', '=', true)->count(); // Banned Users

            return [
                'Total Users' => $totalUsers,
                'Joined Today' => $joinedToday,
                'Online Users' => $onlineUsers,
                'Banned Users' => $bannedUsers,
                'Total Threads' => $totalThreads,
                'Total Replies' => $totalReplies,
                'Replies + Threads' => $totaltf,
                'Total Sets' => $totalGames,
                'Total Items' => $totalItems,
                'Total Staff' => $totalStaff
            ];
        case 'server':
            $serverInfo = [];
           
            // all this is self explanitory, I won't go into too much detail...
            if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
                $cpuUsage = sys_getloadavg()[0] . '%';

                $execFree = explode("\n", trim(shell_exec('free')));
                $getMem = preg_split("/[\s]+/", $execFree[1]);
                $ramUsage = round($getMem[2] / $getMem[1] * 100, 0) . '%';

                $uptime = preg_split("/[\s]+/", trim(shell_exec('uptime')))[2] . ' Days';

                $serverName = trim(shell_exec('hostname'));

                $serverInfo['Server Name'] = $serverName;
                $serverInfo['CPU Usage'] = $cpuUsage ?? '???';
                $serverInfo['RAM Usage'] = $ramUsage ?? '???';
                $serverInfo['PHP Version'] = phpversion();
                $serverInfo['Uptime'] = $uptime ?? '???';

                $totalSpace = shell_exec('df -h / | awk \'{if(NR==2) print $2}\'');
                $usedSpace = shell_exec('df -h / | awk \'{if(NR==2) print $3}\'');

                $serverInfo['Total VPS Space'] = $totalSpace;
                $serverInfo['Used VPS Space'] = $usedSpace;
                $webServerInfo = shell_exec('apache2 -v');
                $webServerInfo = explode("\n", $webServerInfo);
                $webServerInfo = explode(':', $webServerInfo[0]);
                $webServerSoftware = trim($webServerInfo[1]);
                $webServerSoftware = preg_replace('/\([^)]+\)/', '', $webServerSoftware);

                $serverInfo['Apache Version'] = trim($webServerSoftware) ?? '???';
            }

            return $serverInfo;
    }
}
}

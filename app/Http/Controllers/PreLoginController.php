<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * PreLoginController
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Vishwa <Vishvamitra.yadav@vlinkinfo.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://localhost
 */
class PreLoginController extends Controller
{
    /**
     * Pre about exam
     *
     * @return void
     */
    public function preAboutExam()
    {
        return view('about_exam');
    }
    /**
     * User feedback
     *
     * @return void
     */
    public function userFeedback()
    {
        return view('faq');
    }
}

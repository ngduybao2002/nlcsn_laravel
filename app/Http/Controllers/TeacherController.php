<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\HasApiTokens;
use App\Models\Course;
use App\Models\Secondcourse;
use App\Models\Thirdcourse;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Room;

class TeacherController extends Controller
{
    public function publicToTeacher($id)
    {
        $course2 = Secondcourse::where('id_2course', $id)->first();
        if (!$course2) {
            $course = Course::find($id);
            if ($course) {
                $secondcourse = new secondcourse;
                $secondcourse->id_2course = $course->id_course;
                $secondcourse->time_start = $course->time_start;
                $secondcourse->name_course = $course->name_course;
                $secondcourse->weeks = $course->weeks;
                $secondcourse->days = $course->days;
                $secondcourse->lessons = $course->lessons;
                $secondcourse->rooms = $course->rooms;
                $secondcourse->maxStudents = $course->maxStudents;
                $secondcourse->tuitionFee = $course->tuitionFee;
                $secondcourse->teacher = $course->teacher;
                $secondcourse->save();

                return redirect()->back()->with('success', 'Public to teacher successfully!');
            } else {
                return redirect()->back()->with('error', $course2->name_course . ' not found!');
            }
        }
        else {
            return redirect()->back()->with('error', 'You have already made ' . $course2->name_course . ' public to teachers!');
        }
    }

    public function CourseListTeacher(Request $request)
    {
        $search = $request['search'] ?? '';
        if ($search != ''){
            $course2 =  Secondcourse::where('id_2course', 'LIKE', "%$search%")
                                ->orWhere('name_course', 'LIKE', "%$search%")
                                ->orWhere('tuitionFee', 'LIKE', "%$search%")

                                ->orWhere(function ($query) use ($search) {
                                    $query->orWhere('rooms', 'LIKE', "%$search%")
                                        ->orWhereRaw('LENGTH(rooms) = 3 AND rooms LIKE ?', ['%' . $search . '%']);
                                })

                                ->orWhereHas('teacherUser2', function ($query) use ($search) {
                                    $query->where('name', 'LIKE', "%$search%");
                                })

                                ->orWhere(function ($query) use ($search) {
                                    for ($i = 0; $i < 7; $i++) { //Kiem tra 7 ngay trong tuan
                                        $query->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(days, "$['.$i.']"))) LIKE ?', ['%' . strtolower($search) . '%']);
                                    }
                                })
                                ->sortable()->paginate(3);
        }
        else {
            $course2 = Secondcourse::sortable()->paginate(3);
        }
        return view('pages.ql_teacher.courseList_teacher', ['course2' => $course2, 'search' => $search]);
    }

    public function registerCourseTeacher($userId, $courseId)
    {
        $user = User::find($userId);
        $course = Course::find($courseId);
        if($user && $course){

            $course->teacher = $user->id;

            $course->save();

            // Update the is_registered field of the corresponding secondcourse
            $secondcourse = Secondcourse::where('id_2course', $courseId)->first();
            if ($secondcourse) {
                $secondcourse->is_registered = true;
                $secondcourse->teacher = $user->id;
                $secondcourse->save();
            }

            $thirdcourse = Thirdcourse::where('id_3course', $courseId)->first();
            if ($thirdcourse) {
                $thirdcourse->teacher = $user->id;
                $thirdcourse->save();
            }

                return redirect()->back()->with('success', 'Register successfully!');

        } else {

            return redirect()->back()->with('error', 'User or Course not found!');

        }
    }

    public function StudentListTeacher($id)
    {
        $course = Course::find($id);
        if ($course && $course->teacher == Auth::user()->id) {
            $students_list = User::whereIn('id', $course->students_list)->get();
            session(['students_list' => $students_list]); // Lưu dữ liệu vào session
            return redirect()->route('student-list');
        }
        return redirect()->back()->with('error', 'Unauthorized access');
    }

    public function hienthiStudentList()
    {
        $students_list = session('students_list'); // Lấy dữ liệu từ session
        return view('pages.ql_teacher.student_list_teacher', compact('students_list'));
    }

    public function showRLDashBoardTeacher()
    {
        $lessons = Lesson::all();
        $rooms = Room::all();
        return view('dashboard_teacher', compact(['lessons','rooms']));
    }

    public function showCalenderTeacher(): View
    {
        return view('pages.ql_teacher.schedule_teacher');
    }

    public function getRegisteredCoursesTeacher()
    {
        $user = Auth::user();
        $courses = Course::where('teacher', $user->id)->get();
        return $courses;
    }

}

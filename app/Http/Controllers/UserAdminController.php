<?php

namespace App\Http\Controllers;

use App\Services\ApiService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserAdminController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    // Users page
    public function groups(Request $request)
    {
        $data = [
            'userId' => $request->input('userId'),
        ];

        $response = $this->apiService->getData('group/list', $data);



        $grouplist = isset($response['Data']) ? $response['Data'] : [];
        $userDetail = isset($response['UserDetail']) ? $response['UserDetail'] : [];


        return view('group_list', compact('grouplist', 'userDetail'));
    }




    // Posts page


    // public function login(Request $request)
    // {
    //     $data = [
    //         'userId' => $request->input('userId'),
    //         'password' => $request->input('password'),
    //     ];

    //     $admin = $this->apiService->postData('adminlogin', $data);

    //     if (isset($admin['error']) && $admin['error'] === false) {
    //         // If login successful and data exists
    //         if (!empty($admin['data'])) {
    //             session(['admin' => $admin['data']]);
    //         }

    //         return redirect()->route('index')
    //         ; // Optional success message
    //     }

    //     // If login failed
    //     return back()
    //         ->withErrors(['login_error' => $admin['message'] ?? 'Invalid User ID or Password'])
    //         ->withInput();
    // }

    public function login(Request $request)
    {
        $data = [
            'userId' => $request->input('userId'),
            'password' => $request->input('password'),
        ];

        $response = $this->apiService->postData('adminlogin', $data);

        // ✅ API call success (no transport error)
        if (isset($response['error']) && $response['error'] === false) {
            $apiData = $response['data']; // <-- actual API response here

            if (isset($apiData['status']) && $apiData['status'] == 1) {
                // Save into session
                session([
                    'admin' => $apiData['admin'],
                    'token' => $apiData['token'],
                    'expires_at' => $apiData['expires_at'],
                    'login_date' => $apiData['login_date'],
                    'login_time' => $apiData['login_time'],
                ]);

                return redirect()->route('index');
            }

            // ❌ If status not 1
            return back()->withErrors([
                'login_error' => $apiData['message'] ?? 'Invalid User ID or Password'
            ])->withInput();
        }

        // ❌ API transport failed
        return back()->withErrors([
            'login_error' => $response['message'] ?? 'Unexpected API Error'
        ])->withInput();
    }





    public function index()
    {
        return view('index');
    }

    public function viewProfile()
    {
        return view('profile');
    }
    // Jobs page
    public function company()
    {
        $response = $this->apiService->getData('company/list');

        $companylist = $response['DataList'] ?? []; // only Data array
        return view('company_list', compact('companylist'));
    }

    public function eventCalender()
    {
        $response = $this->apiService->getData('eventcalender/list');

        $eventlist = $response['Data'] ?? []; // only Data array
        return view('events_list', compact('eventlist'));
    }

    public function projectList()
    {
        $response = $this->apiService->getData('project/list');

        $projects = $response['Data'] ?? []; // only Data array
        return view('project_list', compact('projects'));
    }

    public function talentList()
    {
        $response = $this->apiService->getData('talent/list');

        $talents = $response['Data'] ?? []; // only Data array
        return view('talent_list', compact('talents'));
    }

    public function careerEnhancers()
    {
        $response = $this->apiService->getData('business/list');

        $companies = $response['Data'] ?? []; // only Data array
        return view('career_enhancers', compact('companies'));
    }



    public function jobList()
    {
        $response = $this->apiService->getData('job/list');

        $jobs = $response['Data'] ?? []; // only Data array
        return view('job_list', compact('jobs'));
    }


    public function postList()
    {
        $response = $this->apiService->getData('post/list');

        $posts = $response['Data'] ?? []; // Data array ko posts naam de diya
        return view('posts_list', compact('posts'));
    }


    public function contactUsList()
    {
        $response = $this->apiService->getData('contactus/list');

        $contacts = $response['data'] ?? []; // key lowercase hai
        return view('list_contact_query', compact('contacts'));
    }



    public function articleList()
    {
        $response = $this->apiService->getData('article/list');

        $articlelist = $response['Data'] ?? []; // Data array ko posts naam de diya
        return view('article_list', compact('articlelist'));
    }



    public function departmentListData()
    {
        $response = $this->apiService->getData('department/list');

        $departments = $response['DataList'] ?? []; // key lowercase hai
        return view('manage_department', compact('departments'));
    }

    public function noticeBoardList()
    {
        // Call your API
        $response = $this->apiService->getData('noticeboard/list');

        // API ke response me "DataList" key hai
        $notices = $response['DataList'] ?? [];

        return view('manage_notice', compact('notices'));
    }


    // ➕ Add new notice
    public function storeNoticeboard(Request $request)
    {
        $data = [
            'title' => $request->input('title'),
            'details' => $request->input('details'),
            'addeddate' => $request->input('addeddate'),   // form se aayega
            'modifydate' => $request->input('modifydate'),  // form se aayega
            'status' => $request->input('status'),
        ];


        $response = $this->apiService->postData('noticeboard/store', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('manage_notice')->with('success', 'Notice created successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to create notice'])->withInput();
    }

    // ✏️ Update notice
    public function updateNoticeBoard(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'title' => $request->input('title'),
            'details' => $request->input('details'),
            'addeddate' => $request->input('addeddate'),
            'modifydate' => now()->format('Y-m-d'),
            'status' => $request->input('status', 'active')
        ];

        $response = $this->apiService->postData('noticeboard/update', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('manage_notice')->with('success', 'Notice updated successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update notice'])->withInput();
    }



    public function manageCourse()
    {
        // Fetch departments
        $deptResponse = $this->apiService->getData('department/list');
        $departmentdata = $deptResponse['DataList'] ?? [];

        // Fetch courses
        $courseResponse = $this->apiService->getData('course/list');
        $courses = $courseResponse['DataList'] ?? [];

        return view('manage_course', compact('departmentdata', 'courses'));
    }

    // 🔹 Add new course
    public function storeCourse(Request $request)
    {
        $data = [
            'dep_id' => $request->input('dep_id'), // store department ID
            'course_name' => $request->input('course_name'),
            'course_code' => $request->input('course_code'),
            'addeddate' => now()->format('Y-m-d'),
            'modifydate' => now()->format('Y-m-d'),
            'status' => $request->input('status'),
        ];

        $response = $this->apiService->postData('course/store', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('manage_course')->with('success', 'Course added successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to add course'])->withInput();
    }


    // 🔹 Update course
    public function updateCourse(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'dep_id' => $request->input('dep_id'), // department ID
            'course_name' => $request->input('course_name'),
            'course_code' => $request->input('course_code'),
            'modifydate' => now()->format('Y-m-d'),
            'status' => $request->input('status') // default to active
        ];

        $response = $this->apiService->postData('course/update', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('manage_course')->with('success', 'Course updated successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update course'])->withInput();
    }




    public function departmentList()
    {
        $response = $this->apiService->getData('department/list');
        $departments = $response['DataList'] ?? [];
        return view('manage_department', compact('departments'));
    }

    // 🔹 Add Department
    public function storeDepartment(Request $request)
    {
        $data = [
            'department_name' => $request->input('department_name'),
            'department_code' => $request->input('department_code'),
            'status' => $request->input('status'),
            'addeddate' => now()->format('Y-m-d'),
            'modifydate' => now()->format('Y-m-d'),
        ];

        $response = $this->apiService->postData('department/store', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('manage_department')->with('success', 'Department added successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to add department'])->withInput();
    }

    // 🔹 Update Department
    public function updateProfile(Request $request)
    {
        $data = $request->only(['id', 'name', 'email', 'company']);
        $response = $this->apiService->postData('admin-profile-update', $data);

        if (
            isset($response['error']) && $response['error'] === false
            && isset($response['data']['status']) && $response['data']['status'] == 1
            && isset($response['data']['admin'])
        ) {
            $updatedAdmin = $response['data']['admin'];

            // Preserve session keys
            $currentSession = session()->only(['token', 'expires_at', 'login_date', 'login_time']);
            session(array_merge($currentSession, ['admin' => $updatedAdmin]));

            // Flash message for next request (shows on page after redirect)
            return redirect()->route('profile.view')->with('successMessage', 'Profile updated successfully!');
        }

        return back()->withErrors([
            'error' => $response['data']['message'] ?? 'Failed to update profile'
        ])->withInput();
    }


    public function updateNewPassword(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'current_password' => $request->input('current_password'),
            'new_password' => $request->input('new_password'),
            'new_password_confirmation' => $request->input('new_password_confirmation')
        ];

        $response = $this->apiService->postData('admin-update-password', $data);

        if (isset($response['error']) && $response['error'] === false) {
            // ✅ Flash message key matches Blade
            return redirect()->back()->with('successMessage', 'Password updated successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update password'])->withInput();
    }











    // 🔹 Update Department
    public function updateDepartment(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'department_name' => $request->input('department_name'),
            'department_code' => $request->input('department_code'),
            'status' => $request->input('status'),
            'modifydate' => now()->format('Y-m-d'),
        ];

        $response = $this->apiService->postData('department/update', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('manage_department')->with('success', 'Department updated successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update department'])->withInput();
    }

    public function updatecompanylist(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'status' => (int) $request->input('status'), // 🔥 integer me convert
        ];

        $response = $this->apiService->postData('company/update', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('company_list')->with('success', 'Company status updated!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update company'])->withInput();
    }




    public function updateGroupStatus(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'status' => (int) $request->input('status'), // convert to integer
        ];

        $response = $this->apiService->postData('group/update', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('group_list')->with('success', 'Company status updated!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update company'])->withInput();
    }



    public function updateEventStatus(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'eventStatus' => (int) $request->input('eventStatus'), // convert to integer
        ];

        $response = $this->apiService->postData('eventcalender/update', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('event_list')->with('success', 'Event status updated!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update event'])->withInput();
    }




    public function updateProjectStatus(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'status' => (int) $request->input('status'), // convert to integer
        ];

        $response = $this->apiService->postData('project/update', $data);


        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('project_list')->with('success', 'Project status updated!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update project'])->withInput();
    }

    public function updatecareerEnhancers(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'status' => (int) $request->input('status'), // convert to integer
        ];

        $response = $this->apiService->postData('business/update', $data);


        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('career_enhancer_list')->with('success', 'Business status updated!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update business'])->withInput();
    }


    public function updateTalentStatus(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'status' => (int) $request->input('status'), // convert to integer
        ];

        $response = $this->apiService->postData('talent/update', $data);


        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('talent_list')->with('success', 'Talent status updated!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update talent'])->withInput();
    }

    public function updateJobStatus(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'status' => (int) $request->input('status'),
        ];

        $response = $this->apiService->postData('job/update', $data);


        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('job_list')->with('success', 'Job status updated!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update job'])->withInput();
    }


    public function updatePostStatus(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'status' => (int) $request->input('status'),
        ];

        $response = $this->apiService->postData('post/update', $data);


        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('post_list')->with('success', 'Post status updated!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update post'])->withInput();
    }




    public function updateArticleStatus(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'status' => (int) $request->input('status'),
        ];

        $response = $this->apiService->postData('article/update', $data);


        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('article_list')->with('success', 'Article status updated!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update article'])->withInput();
    }
    public function updateContactStatus(Request $request)
    {
        $data = [
            'id' => $request->input('id'),
            'status' => (int) $request->input('status'),
        ];

        $response = $this->apiService->postData('contactus/update', $data);


        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('contact_list')->with('success', 'ContactUs status updated!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update contactus'])->withInput();
    }



    public function registrationList()
    {
        $response = $this->apiService->getData('register/list');

        $registers = $response['DataList'] ?? []; // key lowercase hai
        return view('manage_jobfair', compact('registers'));
    }



    public function logout(Request $request)
    {
        // Get token from session
        $token = session('token');

        // Call logout API via apiService
        $response = $this->apiService->postData('/adminlogout', $token);

        // Clear session
        session()->flush();

        // Redirect to login page
        return redirect()->route('loginform')->with('success', 'You have been logged out successfully.');
    }

}

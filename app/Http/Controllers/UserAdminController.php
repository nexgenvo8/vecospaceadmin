<?php

namespace App\Http\Controllers;

use App\Services\ApiService;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

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
                    'permissions' => explode(',', $apiData['permissions']['permissions']) ?? 0,  // ✅ Important: convert to array
                    'user_id' => $apiData['admin']['id'],
                    'expires_at' => now()->addMinutes(30)->timestamp,
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


    public function postList(Request $request)
    {
        // Current page
        $currentPage = $request->input('page', 1);

        // Build pagination params
        $params = [
            'page' => $currentPage,
            'perPage' => 10, // default per page
        ];

        // Fetch post list from API
        $response = $this->apiService->getData('post/list', $params);

        // Extract data
        $posts = $response['DataList'] ?? [];
        $total = $response['total'] ?? 0;
        $perPage = $response['per_page'] ?? 10;
        $lastPage = $response['last_page'] ?? 1;
        $currentPage = $response['current_page'] ?? 1;

        // Return view with pagination data
        return view('posts_list', compact('posts', 'total', 'perPage', 'lastPage', 'currentPage'));
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



    public function rolePermission()
    {
        $response = $this->apiService->postData('list-profile');

        // Extract 'Data' from nested structure
        $roles = $response['data']['Data'] ?? [];

        return view('roles_permissions', compact('roles'));
    }



    public function editrolePermission(Request $request)
    {
        $userId = (int) $request->query('user_id');

        if (!$userId) {
            return redirect()->back()->with('error', 'User ID is required');
        }

        $data = ['user_id' => $userId];

        $response = $this->apiService->getData('rolepermissions/list-roles-permissions', $data);

        $userRoles = $response['data'] ?? [];

        // Properly fetch the specific user role
        $userRole = collect($userRoles)->firstWhere('user_id', $userId);

        return view('edit_roles_permissions', compact('userRole'));
    }







    public function updaterolePermission(Request $request)
    {
        // Prepare data to send to API
        $data = [
            'user_id' => (int) $request->input('user_id'),
            'role_name' => $request->input('role_name'),
            'permissions' => $request->input('permissions', []), // array of selected permissions
        ];

        // Send JSON data to API
        $response = $this->apiService->postJson('rolepermissions/add-roles-permissions', $data);

        // Check API response
        if (isset($response['error']) && $response['error'] === false) {
            // Success → redirect to roles_permissions_list with success message
            return redirect()->route('roles_permissions_list')->with('success', 'Role Permission Insertred successfully!');
        }

        // Failure → redirect back with error message
        $errorMessage = $response['message'] ?? 'Failed to update Role Permission';
        return redirect()->back()->with('error', $errorMessage);
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


    public function recordCount()
    {
        // Departments
        $departmentResponse = $this->apiService->getData('department/list');
        $totalDepartments = $departmentResponse['TotalRecord'] ?? 0;

        // Registers (with user type summary)
        $registerResponse = $this->apiService->getData('register/list');
        $totalRegisters = $registerResponse['total'] ?? 0;

        // Extract user type summary if available
        $userTypeSummary = $registerResponse['user_type_summary'] ?? [
            'Student' => 0,
            'Faculty' => 0,
            'Alumni' => 0,
            'Industry Professional' => 0,
            'Career Enhancer / Service Provider' => 0
        ];

        // Posts
        $postResponse = $this->apiService->getData('post/list');
        $totalPosts = $postResponse['total'] ?? 0;

        // Courses
        $courseResponse = $this->apiService->getData('course/list');
        $totalCourses = $courseResponse['TotalRecord'] ?? 0;

        // Pass all data to view
        return view('index', compact(
            'totalDepartments',
            'totalRegisters',
            'totalPosts',
            'totalCourses',
            'userTypeSummary'
        ));
    }


    public function permissionsList()
    {
        $response = $this->apiService->getData('rolepermissions/list-roles-permissions');
        $permissions = $response['data'] ?? [];

        return view('permissions_list', compact('permissions'));
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




    public function updateUserStatus(Request $request)
    {
        $data = [
            'userId' => $request->input('userId'),
            'activeYN' => $request->input('activeYN'), // ✅ correct key
        ];

        $response = $this->apiService->postData('user/updatestatus', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('user_subscription_list')->with('success', 'User status updated!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update user'])->withInput();
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
            'viewStatus' => (int) $request->input('viewStatus'), // convert to integer
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



    public function registrationList(Request $request)
    {
        $currentPage = $request->input('page', 1);

        // Build filters array
        $filters = [
            'page' => $currentPage,
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'userstype' => $request->input('userstype'), // if you want to filter by type also
        ];

        // Remove null/empty values
        $filters = array_filter($filters, fn($value) => !is_null($value) && $value !== '');

        // Fetch paginated registration list from API with filters
        $response = $this->apiService->getData('register/list', $filters);

        $registers = $response['DataList'] ?? [];
        $total = $response['total'] ?? 0;
        $perPage = $response['per_page'] ?? 10;
        $lastPage = $response['last_page'] ?? 1;
        $currentPage = $response['current_page'] ?? 1;

        return view('manage_jobfair', compact('registers', 'total', 'perPage', 'lastPage', 'currentPage'));
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




    public function manageUserData()
    {
        $deptResponse = $this->apiService->getData('department/list');
        $departments = $deptResponse['DataList'] ?? [];

        $courseResponse = $this->apiService->getData('course/list');
        $courses = $courseResponse['DataList'] ?? [];



        return view('subscription_list', compact('courses'));
    }


    public function userList(Request $request)
    {
        $currentPage = $request->input('page', 1);

        // Fetch courses and departments
        $courseResponse = $this->apiService->getData('course/list');
        $courses = $courseResponse['DataList'] ?? [];

        $deptResponse = $this->apiService->getData('department/list');
        $departments = $deptResponse['DataList'] ?? [];

        // Build filters array
        $filters = [
            'page' => $currentPage,
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'userstype' => $request->input('userstype'),
        ];

        // Remove null/empty values
        $filters = array_filter($filters, fn($value) => !is_null($value) && $value !== '');

        // Fetch user list with filters
        $response = $this->apiService->getData('user/listusers', $filters);

        $dataList = $response['DataList'] ?? [];
        $total = $response['total'] ?? 0;
        $perPage = $response['per_page'] ?? 10;
        $lastPage = $response['last_page'] ?? 1;
        $currentPage = $response['current_page'] ?? 1;

        return view('subscription_list', compact('dataList', 'courses', 'departments', 'total', 'perPage', 'lastPage', 'currentPage'));
    }




    public function updateUser(Request $request)
    {
        $data = [
            'userId' => $request->input('userId'),
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'userstype' => $request->input('userstype'),
            'coursename' => $request->input('course_name'),        // Match form field name
            'departmentname' => $request->input('department_name'),   // Match form field name
            'passingyear' => $request->input('passingyear'),
        ];

        $response = $this->apiService->postData('user/updateusers', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('user_subscription_list')->with('success', 'User updated successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update user'])->withInput();
    }



    public function importedUsers(Request $request)
    {
        try {
            $file = $request->file('excel_file');

            if (!$file || !$file->isValid()) {
                return response()->json([
                    'status' => 0,
                    'message' => 'No valid file uploaded.'
                ], 400);
            }

            $client = new Client();

            $apiUrl = env('API_URL');  // Or config('app.api_url') if set in config/app.php

            $response = $client->post($apiUrl . 'usersimport', [
                'multipart' => [
                    [
                        'name' => 'excel_file',
                        'contents' => fopen($file->getPathname(), 'r'),
                        'filename' => $file->getClientOriginalName(),
                    ],
                ],
            ]);


            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);

            if (!is_array($responseData)) {
                throw new \Exception('Invalid API response format');
            }

            return response()->json($responseData);

        } catch (\Exception $e) {
            \Log::error('Import Exception:', ['message' => $e->getMessage()]);

            return response()->json([
                'status' => 0,
                'message' => 'Error during API call: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function resendEmail(Request $request)
    {
        $userId = (int) $request->input('userId');  // Get from POST input
        $email = $request->input('to');           // Get from POST input

        if (!$userId || !$email) {
            return back()->withErrors(['error' => 'User ID and Email are required']);
        }

        $data = [
            'to' => $email,
            'userId' => $userId,
            'settingId' => 3,
            'templateId' => 123,
        ];

        // For debugging, you can remove dd($data) in production
        // dd($data);

        $response = $this->apiService->postData('sendregisteremail', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('user_subscription_list')
                ->with('success', 'Email has been resent successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to resend email']);
    }





    public function menuPages()
    {
        $pagedata = $this->apiService->getData('pages/listmenu');

        return view('manage_page', compact('pagedata'));
    }


    public function mangefaqs()
    {
        $faqdata = $this->apiService->getData('pages/listfaq');

        return view('manage_faq', compact('faqdata'));
    }
    public function createMenuPages(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'txtDescription' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keyword' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1',
            'backpage' => 'nullable|string|max:255',
            'type' => 'required|string|in:menu,page', // adjust as per your allowed types
        ]);

        // Prepare data for API
        $data = [
            'title' => $request->input('title'),
            'txtDescription' => $request->input('txtDescription'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keyword' => $request->input('meta_keyword'),
            'status' => $request->input('status'),
            'backpage' => $request->input('backpage'),
            'type' => $request->input('type'),
        ];

        // Send data to API
        $response = $this->apiService->postData('pages/store', $data);

        // Handle response
        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('manupageslist')->with('success', 'Page created successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to create page'])->withInput();
    }


    public function updateMenuPages(Request $request)
    {
        // Validate request
        $request->validate([
            'id' => 'required|integer', // The page ID to update
            'title' => 'nullable|string|max:255',
            'txtDescription' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keyword' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1',
            'backpage' => 'nullable|string|max:255',
            'type' => 'nullable|string|in:menu,page', // adjust based on your allowed types
        ]);

        // Prepare data for API
        $data = [
            'id' => $request->input('id'),
            'title' => $request->input('title'),
            'txtDescription' => $request->input('txtDescription'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keyword' => $request->input('meta_keyword'),
            'status' => $request->input('status'),
            'backpage' => $request->input('backpage'),
            'type' => $request->input('type'),
        ];

        // Send update request to API
        $response = $this->apiService->postData('pages/update', $data);

        // Handle response
        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('manupageslist')->with('success', 'Page updated successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update page'])->withInput();
    }






    public function updateMenuPageStatus(Request $request)
    {
        // Validate request
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|integer|in:0,1',
        ]);

        // Prepare data for API
        $data = [
            'id' => $request->input('id'),
            'status' => $request->input('status'),
        ];

        // Send update request to API
        $response = $this->apiService->postData('pages/updatestatus', $data);
        // Handle response
        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('manupageslist')->with('success', 'Page updated successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update page'])->withInput();
    }




    public function deleteMenuPages(Request $request)
    {
        // Validate request
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Prepare data for API
        $data = ['id' => $request->input('id')];

        // Send delete request to API
        $response = $this->apiService->postData('pages/delete', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return response()->json([
                'message' => 'Page deleted successfully',
                'data' => $response['data'] ?? null
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => $response['message'] ?? 'Failed to delete page'
        ], 400);
    }



    public function faqCreatedPages(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'txtDescription' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keyword' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1',
            'backpage' => 'nullable|string|max:255',
            'type' => 'required|string', // adjust as per your allowed types
        ]);

        // Prepare data for API
        $data = [
            'title' => $request->input('title'),
            'txtDescription' => $request->input('txtDescription'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keyword' => $request->input('meta_keyword'),
            'status' => $request->input('status'),
            'backpage' => $request->input('backpage'),
            'type' => $request->input('type'),
        ];

        // Send data to API
        $response = $this->apiService->postData('pages/store', $data);

        // Handle response
        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('faqpageslist')->with('success', 'aq created successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to create page'])->withInput();
    }


    public function updateFaqPages(Request $request)
    {
        // Validate request
        $request->validate([
            'id' => 'required|integer', // The page ID to update
            'title' => 'nullable|string|max:255',
            'txtDescription' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keyword' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1',
            'backpage' => 'nullable|string|max:255',
            'type' => 'nullable|string', // adjust based on your allowed types
        ]);

        // Prepare data for API
        $data = [
            'id' => $request->input('id'),
            'title' => $request->input('title'),
            'txtDescription' => $request->input('txtDescription'),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keyword' => $request->input('meta_keyword'),
            'status' => $request->input('status'),
            'backpage' => $request->input('backpage'),
            'type' => $request->input('type'),
        ];

        // Send update request to API
        $response = $this->apiService->postData('pages/update', $data);

        // Handle response
        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('faqpageslist')->with('success', 'Page updated successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update page'])->withInput();
    }






    public function updateFaqPageStatus(Request $request)
    {
        // Validate request
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|integer|in:0,1',
        ]);

        // Prepare data for API
        $data = [
            'id' => $request->input('id'),
            'status' => $request->input('status'),
        ];

        // Send update request to API
        $response = $this->apiService->postData('pages/updatestatus', $data);
        // Handle response
        if (isset($response['error']) && $response['error'] === false) {
            return redirect()->route('faqpageslist')->with('success', 'Page updated successfully!');
        }

        return back()->withErrors(['error' => $response['message'] ?? 'Failed to update page'])->withInput();
    }




    public function deleteFaqPages(Request $request)
    {
        // Validate request
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Prepare data for API
        $data = ['id' => $request->input('id')];

        // Send delete request to API
        $response = $this->apiService->postData('pages/delete', $data);

        if (isset($response['error']) && $response['error'] === false) {
            return response()->json([
                // 'message' => 'Page deleted successfully',
                'data' => $response['data'] ?? null
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => $response['message'] ?? 'Failed to delete page'
        ], 400);
    }

}














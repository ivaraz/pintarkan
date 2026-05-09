<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::with(['student', 'lecturer'])->paginate(15);
        return view('admin.dashboard', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.create-user');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,lecturer,student'],
            'name' => ['nullable', 'string', 'max:255', 'required_if:role,lecturer,student'],
            'npm' => ['nullable', 'string', 'max:20', 'required_if:role,student', 'unique:students,npm'],
            'nidn' => ['nullable', 'string', 'max:20', 'required_if:role,lecturer', 'unique:lecturers,nidn'],
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Role harus dipilih',
            'name.required_if' => 'Nama harus diisi untuk role ini',
            'npm.required_if' => 'NPM harus diisi untuk student',
            'npm.unique' => 'NPM sudah terdaftar',
            'nidn.required_if' => 'NIDN harus diisi untuk dosen',
            'nidn.unique' => 'NIDN sudah terdaftar',
        ]);

        try {

            // dd($validated);
            // Role::findOrCreate('student');
            // Role::findOrCreate('lecturer');
            // Buat user baru
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ])->assignRole($validated['role']);

            // // Buat Student atau Lecturer jika diperlukan
            if ($validated['role'] === 'student') {
                Student::create([
                    'user_id' => $user->id,
                    'name' => $validated['name'],
                    'npm' => $validated['npm'],
                ]);
            }
            elseif ($validated['role'] === 'lecturer') {
                Lecturer::create([
                    'user_id' => $user->id,
                    'name' => $validated['name'],
                    'nidn' => $validated['nidn'],
                ]);
            }
            $notif = array('message' => 'User berhasil dibuat: ' . $validated['email'], 'alert-type' => 'success');
            return redirect()->route('admin.dashboard')
                ->with($notif);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }



    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user->load(['students', 'lecturers']);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $user->load(['students', 'lecturers']);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,dosen,student'],
            'name' => ['nullable', 'string', 'max:255'],
            'npm' => ['nullable', 'string', 'max:20'],
            'nidn' => ['nullable', 'string', 'max:20'],
        ]);

        try {
            $user->email = $validated['email'];

            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();

            // Update atau buat Student/Lecturer
            if ($validated['role'] === 'student') {
                Student::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'name' => $validated['name'],
                        'npm' => $validated['npm'] ?? null,
                    ]
                );
            } elseif ($validated['role'] === 'lecturer') {
                Lecturer::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'name' => $validated['name'],
                        'nidn' => $validated['nidn'] ?? null,
                    ]
                );
            }

            return back()->with('success', 'User berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        try {
            // Hapus Student atau Lecturer terkait
            if ($user->students) {
                $user->student->delete();
            }
            if ($user->lecturer) {
                $user->lecturer->delete();
            }

            $user->delete();
            return back()->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

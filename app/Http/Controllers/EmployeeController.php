<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Afficher la liste des employés.
     */
    public function index(Request $request): View
    {
        $userId = auth()->id();
        $search = $request->query('search');

        $employees = Employee::where('user_id', $userId)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('position', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('employees.index', compact('employees', 'search'));
    }

    /**
     * Enregistrer un nouvel employé.
     */
    public function store(Request $request): RedirectResponse
    {
        $userId = auth()->id();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('employees', 'email')->where(fn ($query) => $query->where('user_id', $userId)),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'position' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'numeric', 'min:0'],
            'hire_date' => ['nullable', 'date'],
        ]);

        Employee::create([
            'user_id' => $userId,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'position' => $validated['position'] ?? null,
            'salary' => $validated['salary'] ?? null,
            'hire_date' => $validated['hire_date'] ?? null,
        ]);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employé ajouté avec succès.');
    }

    /**
     * Mettre à jour un employé existant.
     */
    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $userId = auth()->id();

        $employee = Employee::where('user_id', $userId)->findOrFail($employee->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('employees', 'email')
                    ->where(fn ($query) => $query->where('user_id', $userId))
                    ->ignore($employee->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'position' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'numeric', 'min:0'],
            'hire_date' => ['nullable', 'date'],
        ]);

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employé mis à jour avec succès.');
    }

    /**
     * Supprimer un employé.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $employee = Employee::where('user_id', auth()->id())->findOrFail($employee->id);

        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employé supprimé avec succès.');
    }
}
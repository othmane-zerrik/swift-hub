<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Afficher la liste des employés.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $employees = Employee::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('position', 'like', "%{$search}%");
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
        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', 'unique:employees,email'],
            'phone'     => ['nullable', 'string', 'max:30'],
            'position'  => ['nullable', 'string', 'max:255'],
            'salary'    => ['nullable', 'numeric', 'min:0'],
            'hire_date' => ['nullable', 'date'],
        ]);

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employé ajouté avec succès.');
    }

    /**
     * Mettre à jour un employé existant.
     */
    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', 'unique:employees,email,' . $employee->id],
            'phone'     => ['nullable', 'string', 'max:30'],
            'position'  => ['nullable', 'string', 'max:255'],
            'salary'    => ['nullable', 'numeric', 'min:0'],
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
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employé supprimé avec succès.');
    }
}
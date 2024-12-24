<?php

namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    // Mostrar formulario de creación
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para crear un trabajo.');
        }

        return view('jobs.create');
    }

    // Guardar nuevo trabajo
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar un trabajo.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'status' => 'required|string|in:open,closed,pending',
            'numero_whatsapp' => ['required', 'string', 'max:9', 'regex:/^9\d{8}$/'],
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('public/jobs')
            : null;

        Job::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'company_name' => $request->company_name,
            'salary' => $request->salary,
            'status' => $request->status,
            'numero_whatsapp' => $request->numero_whatsapp,
            'image' => $imagePath,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Trabajo agregado exitosamente.');
    }

    // Listar trabajos
    public function index(Request $request)
    {
        $orderBy = $request->get('order', 'recent'); // "recent" o "relevant"

        $jobs = Job::query()
            ->when($orderBy === 'recent', fn($query) => $query->orderBy('created_at', 'desc'))
            ->when($orderBy === 'relevant', fn($query) => $query->where('status', 'open')->orderBy('created_at', 'desc'))
            ->get();

        return view('jobs.index', compact('jobs', 'orderBy'));
    }

    
    public function search(Request $request)
    {
        // Verificar si el usuario no está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Por favor, inicia sesión para realizar la búsqueda.');
        }
    
        // Obtener los parámetros de la búsqueda
        $query = $request->input('query');
        $order = $request->input('order', 'recent');
    
        // Realizar la consulta de trabajos
        $jobs = Job::query()
            ->when($query, function($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'ILIKE', '%' . $query . '%');
            })
            ->when($order == 'recent', fn($queryBuilder) => $queryBuilder->orderBy('created_at', 'desc'))
            ->when($order == 'relevant', fn($queryBuilder) => $queryBuilder->orderBy('created_at', 'desc')->where('status', 'open'))
            ->get();
    
        // Si es una solicitud AJAX, solo retornar los trabajos
        if ($request->ajax()) {
            return view('jobs.partials.job-list', compact('jobs'));
        }
    
        // Retornar la vista de trabajos con la consulta y el orden
        return view('jobs.index', compact('jobs', 'query', 'order'));
    }
    // Listar trabajos del usuario autenticado
    public function myJobs()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus trabajos.');
        }

        $jobs = Auth::user()->jobs;
        return view('jobs.myjobs', compact('jobs'));
    }

    // Editar trabajo
    public function edit(Job $job)
    {
        if ($job->user_id !== Auth::id()) {
            return redirect()->route('jobs.myjobs')->with('error', 'No tienes permiso para editar este trabajo.');
        }

        return view('jobs.edit', compact('job'));
    }

    // Actualizar trabajo
    public function update(Request $request, Job $job)
    {
        if ($job->user_id !== Auth::id()) {
            return redirect()->route('jobs.myjobs')->with('error', 'No tienes permiso para actualizar este trabajo.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'status' => 'required|string|in:open,closed,pending',
            'numero_whatsapp' => ['required', 'string', 'max:9'],

            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $job->update($request->except('image'));

        if ($request->hasFile('image')) {
            if ($job->image) {
                Storage::delete($job->image);
            }

            $job->image = $request->file('image')->store('public/jobs');
            $job->save();
        }

        return redirect()->route('jobs.myjobs')->with('success', 'Trabajo actualizado exitosamente.');
    }

    // Eliminar trabajo
    public function destroy(Job $job)
    {
        if ($job->user_id !== Auth::id()) {
            return redirect()->route('jobs.myjobs')->with('error', 'No tienes permiso para eliminar este trabajo.');
        }

        if ($job->image) {
            Storage::delete($job->image);
        }

        $job->delete();
        return redirect()->route('jobs.myjobs')->with('success', 'Trabajo eliminado exitosamente.');
    }
}

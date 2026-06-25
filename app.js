let deleteTargetId = null;

document.addEventListener("DOMContentLoaded", () => {
    fetchStudents();

    document.getElementById("search").addEventListener("input", (e) => {
        fetchStudents(e.target.value);
    });
});


async function fetchStudents(query = '') {
    const res = await fetch(`api.php?action=read&search=${encodeURIComponent(query)}`);
    const data = await res.json();
    const tbody = document.getElementById("studentTableBody");
    tbody.innerHTML = "";

    if (data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" class="py-8 text-center text-gray-400 text-sm">No student records found.</td></tr>`;
        return;
    }

    data.forEach(student => {
        tbody.innerHTML += `
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="py-3 px-4 font-medium text-gray-900">${student.student_name}</td>
                <td class="py-3 px-4 text-gray-600">${student.course}</td>
                <td class="py-3 px-4 text-gray-600">${student.year_level}</td>
                <td class="py-3 px-4 text-right space-x-3">
                    <button onclick='openModal("edit", ${JSON.stringify(student)})' class="text-gray-900 hover:underline text-xs font-medium cursor-pointer">Edit</button>
                    <button onclick="openDeleteModal(${student.id})" class="text-red-600 hover:underline text-xs font-medium cursor-pointer">Delete</button>
                </td>
            </tr>
        `;
    });
}

function openModal(type, data = null) {
    const modal = document.getElementById("studentModal");
    const title = document.getElementById("modalTitle");
    const form = document.getElementById("studentForm");
    
    form.reset();
    document.getElementById("studentId").value = "";

    if (type === "edit" && data) {
        title.innerText = "Edit Student Details";
        document.getElementById("studentId").value = data.id;
        document.getElementById("studentName").value = data.student_name;
        document.getElementById("studentCourse").value = data.course;
        document.getElementById("studentYear").value = data.year_level;
    } else {
        title.innerText = "Add New Student";
    }
    modal.classList.remove("hidden");
}

function openDeleteModal(id) {
    deleteTargetId = id;
    document.getElementById("deleteModal").classList.remove("hidden");
    document.getElementById("confirmDeleteBtn").onclick = confirmDelete;
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add("hidden");
}

async function saveStudent(e) {
    e.preventDefault();
    
    const id = document.getElementById("studentId").value;
    const action = id ? 'update' : 'create';

    const formData = new FormData();
    if (id) formData.append('id', id);
    formData.append('student_name', document.getElementById("studentName").value);
    formData.append('course', document.getElementById("studentCourse").value);
    formData.append('year_level', document.getElementById("studentYear").value);

    const res = await fetch(`api.php?action=${action}`, {
        method: 'POST',
        body: formData
    });
    
    const result = await res.json();
    if (result.success) {
        closeModal("studentModal");
        fetchStudents(document.getElementById("search").value);
    }
}

async function confirmDelete() {
    if (!deleteTargetId) return;
    
    const formData = new FormData();
    formData.append('id', deleteTargetId);

    const res = await fetch(`api.php?action=delete`, {
        method: 'POST',
        body: formData
    });

    const result = await res.json();
    if (result.success) {
        closeModal("deleteModal");
        fetchStudents(document.getElementById("search").value);
        deleteTargetId = null;
    }
}
document.addEventListener('DOMContentLoaded', function() {
    // Fetch branches and populate dropdown
    fetch('fetch_branches.php')
        .then(response => response.json())
        .then(data => {
            const branchSelect = document.getElementById('branch');
            data.forEach(branch => {
                const option = document.createElement('option');
                option.value = branch.id;
                option.textContent = branch.name;
                branchSelect.appendChild(option);
            });
        });

    // Event listener for branch dropdown change
    document.getElementById('branch').addEventListener('change', function() {
        // Fetch subjects for the selected branch and populate dropdown
        const branchId = this.value;
        if (branchId !== '') {
            fetch(`fetch_subjects.php?branch_id=${branchId}`)
                .then(response => response.json())
                .then(data => {
                    const subjectSelect = document.getElementById('subject');
                    subjectSelect.innerHTML = '<option value="">Select Subject</option>';
                    data.forEach(subject => {
                        const option = document.createElement('option');
                        option.value = subject.id;
                        option.textContent = subject.name;
                        subjectSelect.appendChild(option);
                    });
                });

            // Fetch faculty for the selected branch and populate dropdown
            fetch(`fetch_faculty.php?branch_id=${branchId}`)
                .then(response => response.json())
                .then(data => {
                    const facultySelect = document.getElementById('faculty');
                    facultySelect.innerHTML = '<option value="">Select Faculty</option>';
                    data.forEach(faculty => {
                        const option = document.createElement('option');
                        option.value = faculty.id;
                        option.textContent = faculty.name;
                        facultySelect.appendChild(option);
                    });
                });
        }
    });

    // Event listener for Generate Form button
    document.getElementById('generateFormBtn').addEventListener('click', function() {
        const branchId = document.getElementById('branch').value;
        const subjectId = document.getElementById('subject').value;
        const facultyId = document.getElementById('faculty').value;

        if (branchId !== '' && subjectId !== '' && facultyId !== '') {
            // Fetch form fields dynamically based on selected options
            fetch(`generate_form.php?branch_id=${branchId}&subject_id=${subjectId}&faculty_id=${facultyId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('formContainer').innerHTML = html;
                    document.getElementById('formContainer').classList.remove('hidden');
                });
        } else {
            alert('Please select Branch, Subject, and Faculty.');
        }
    });

    // Event listener for Submit Form button
    document.getElementById('submitFormBtn').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('feedbackForm'));
        const branchId = document.getElementById('branch').value;
        const subjectId = document.getElementById('subject').value;
        const facultyId = document.getElementById('faculty').value;
        formData.append('branch_id', branchId);
        formData.append('subject_id', subjectId);
        formData.append('faculty_id', facultyId);

        fetch('submit_feedback.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(message => {
            alert(message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

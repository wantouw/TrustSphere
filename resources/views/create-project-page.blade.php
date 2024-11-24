@extends('layouts.main-layout')

@section('title', 'Create Project')

@section('content')
    <div>
        <form onsubmit="event.preventDefault(); sendApiRequest();" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Project Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="projectTitle" name="title"
                    placeholder="Title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="Description">Project Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Project Description" rows="3">{{ old('Description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="projectImages" class="form-label">Project Images</label>
                <input class="form-control" type="file" id="projectImages" multiple name="images[]">
            </div>

            <div class="mb-3">
                <label class="form-label">Selected Categories</label>
                <div id="selectedCategories" class="mb-2">
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="categorySearch" class="form-label">Project Category</label>
                <input type="text" class="form-control" id="categorySearch"
                    placeholder="Search or type to create a new category">

                <div class="dropdown-menu hide" id="categorySuggestions"
                    style="width: 100%; max-height: 200px; overflow-y: auto;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        const categories = @json($categories);
        const searchInput = document.getElementById('categorySearch');
        const suggestionsBox = document.getElementById('categorySuggestions');
        const selectedCategories = document.getElementById('selectedCategories');
        const metaElements = document.querySelectorAll('meta[name="csrf-token"]');
        const csrf = metaElements.length > 0 ? metaElements[0].content : "";
        const selectedCategoryIds = [];

        function renderSuggestions(input) {
            const query = input.toLowerCase();
            suggestionsBox.innerHTML = '';

            const filteredCategories = categories.filter(category =>
                category.name.toLowerCase().includes(query) && !selectedCategoryIds.includes(category.id)
            );

            filteredCategories.forEach(category => {
                const option = document.createElement('a');
                option.href = '#';
                option.className = 'dropdown-item';
                option.textContent = category.name;
                option.onclick = () => {
                    addCategory(category);
                    searchInput.value = '';
                    suggestionsBox.innerHTML = '';
                };
                suggestionsBox.appendChild(option);
            });

            if (!filteredCategories.length && query) {
                const createOption = document.createElement('a');
                createOption.href = '#';
                createOption.className = 'dropdown-item text-primary';
                createOption.textContent = `Create new category: "${input}"`;
                createOption.onclick = () => {
                    if (input) {
                        createCategory(input);
                    }
                };
                suggestionsBox.appendChild(createOption);
            }
        }

        function addCategory(category) {
            if (selectedCategoryIds.includes(category.id)) {
                console.log('Category udah dipilih');
                return;
            }

            selectedCategoryIds.push(category.id);
            const categoryChip = document.createElement('div');
            categoryChip.className = 'badge bg-primary me-2 mb-2 py-2 px-4';
            categoryChip.textContent = category.name;
            categoryChip.setAttribute('data-id', category.id);

            const removeBtn = document.createElement('span');
            removeBtn.textContent = ' ×';
            removeBtn.className = 'ms-1 text-danger';
            removeBtn.style.cursor = 'pointer';
            removeBtn.onclick = () => {
                selectedCategoryIds.splice(selectedCategoryIds.indexOf(category.id), 1);
                categoryChip.remove();
            };

            categoryChip.appendChild(removeBtn);
            selectedCategories.appendChild(categoryChip);
        }

        function createCategory(newCategoryName) {
            fetch('http://localhost:8000/category/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': csrf,
                    },
                    body: JSON.stringify({
                        name: newCategoryName
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => Promise.reject(err));
                    }
                    return response.json();
                })
                .then(data => {
                    categories.push({
                        id: data.id,
                        name: data.name
                    });
                    addCategory({
                        id: data.id,
                        name: data.name
                    });
                    searchInput.value = '';
                    suggestionsBox.innerHTML = '';
                })
                .catch(error => {
                    console.error('Error adding category:', error);
                    // alert(error.message || 'Failed to create category.');
                });
        }

        searchInput.addEventListener('input', () => {
            const input = searchInput.value.trim();
            if (input) {
                suggestionsBox.classList.remove('hide');
                suggestionsBox.classList.add('show');
                renderSuggestions(input);
            } else {
                suggestionsBox.classList.add('hide');
                suggestionsBox.classList.remove('show');
                suggestionsBox.innerHTML = '';
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('#categorySearch') && !e.target.closest('#categorySuggestions')) {
                suggestionsBox.classList.add('hide');
                suggestionsBox.classList.remove('show');
            }
        });


        function sendApiRequest() {
            const formData = new FormData();
            formData.append('title', document.getElementById('title').value);
            formData.append('description', document.getElementById('description').value);

            selectedCategoryIds.forEach(id => formData.append('categories[]', id));

            const files = document.getElementById('projectImages').files;
            for (let i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }

            fetch('http://localhost:8000/project/create', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': csrf,
                    },
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => Promise.reject(err));
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Project created:', data);
                    alert('Project successfully created!');
                })
                .catch(error => {
                    console.error('Error creating project:', error);
                });
        }
    </script>
@endsection

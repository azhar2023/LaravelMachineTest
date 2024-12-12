<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Search</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- Styles -->
</head>
<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
               
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
                      
            <form class="max-w-md mx-auto mb-10">   
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search branch name..." required />

                </div>
            </form>

            <div class="grid grid-cols-2 gap-2 " id="usersContainer">

     
               
               
                             
            </div>
        </div>
    </div>
</body>


<script>
    let usersContainer = $('#usersContainer');

    let users = @json($users);

        users.forEach(function(user) {
            
        var userName = user.name ? user.name : 'No Name'; 
        var userDepartment = user.designations.name  ? user.designations.name : 'No Department'; 
        var userDesignation = user.departments.name  ? user.departments.name : 'No Designation';
        
        var userCard = 
            `<a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${userName}</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">${userDepartment}</p>
            <p class="font-normal text-gray-700 dark:text-gray-400">${userDesignation}</p>
            </a>`; 

        usersContainer.append(userCard);
        });


    function Users(users) {
        usersContainer.empty(); 
        users.forEach(function(user) {

            var newUserName = user.name ? user.name : 'No Name'; 
            var newUserDepartment = user.designations.name  ? user.designations.name : 'No Department'; 
            var newUserDesignation = user.departments.name  ? user.departments.name : 'No Designation';

            let userCard = `
                <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${newUserName}</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">${newUserDepartment}</p>
                    <p class="font-normal text-gray-700 dark:text-gray-400">${newUserDesignation}</p>
                </a>
            `;

            usersContainer.append(userCard);
        });
    }

    $(document).ready(function() {
        $('#search').on('keyup', function() {
            let inputValue = $(this).val();

            $.ajax({
                url: "{{ route('search-data') }}", 
                type: 'GET',
                data: { input: inputValue, "_token": "{{ csrf_token() }}" },
                success: function(response) {
                    Users(response); 
                },
                error: function(xhr, status, error) {
                    console.error(xhr, status, error);
                }
            });
        });
    });
</script>


</html>

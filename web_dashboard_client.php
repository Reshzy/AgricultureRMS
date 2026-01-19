<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claveria DA - Farmers Record Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
        
        .sidebar {
            transition: all 0.3s ease;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar.collapsed .nav-text {
            display: none;
        }
        
        .sidebar.collapsed .logo-text {
            display: none;
        }
        
        .sidebar.collapsed .nav-item {
            justify-content: center;
        }
        
        .main-content {
            transition: all 0.3s ease;
        }
        
        .main-content.expanded {
            margin-left: 80px;
        }
        
        .dashboard-card {
            transition: transform 0.3s ease;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        .leaf-icon {
            color: #4CAF50;
        }
        
        .farmer-photo {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #e2e8f0;
        }
        
        .pagination .page-item.active .page-link {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        
        .pagination .page-link {
            color: #4CAF50;
        }
        
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        /* Animation for notifications */
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .notification {
            animation: slideIn 0.3s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Sidebar navigation - fixed position with farmer management links -->
    <!-- Sidebar -->
    <div class="sidebar fixed h-screen bg-green-800 text-white w-64 z-50 shadow-lg" id="sidebar">
        <div class="p-4 flex items-center space-x-3 border-b border-green-700">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/Department_of_Agriculture_%28DA%29.svg/1200px-Department_of_Agriculture_%28DA%29.svg.png" alt="DA Logo" class="w-10 h-10">
            <span class="logo-text text-xl font-bold">Claveria DA</span>
        </div>
        
        <div class="p-4">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-12 h-12 rounded-full bg-green-600 flex items-center justify-center">
                    <i class="fas fa-user-tie text-xl"></i>
                </div>
                <div class="nav-text">
                    <div class="font-medium">Admin User</div>
                    <div class="text-xs text-green-200">Administrator</div>
                </div>
            </div>
            
            <ul class="space-y-2">
                <li>
                    <a href="#" class="nav-item flex items-center space-x-3 p-3 rounded-lg bg-green-700">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Farmers</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-tractor"></i>
                        <span class="nav-text">Farm Lots</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-seedling"></i>
                        <span class="nav-text">Crops</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-text">Reports</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-cog"></i>
                        <span class="nav-text">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="absolute bottom-0 w-full p-4 border-t border-green-700">
            <a href="#" class="nav-item flex items-center space-x-3 p-3 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-text">Logout</span>
            </a>
        </div>
    </div>
    
    <!-- Main Content area containing all dashboard components -->
    <!-- Main Content -->
    <div class="main-content ml-64 min-h-screen" id="mainContent">
        <!-- Top Navigation bar with page title and user controls -->
        <!-- Top Navigation -->
        <nav class="bg-white shadow-sm py-3 px-6 flex justify-between items-center sticky top-0 z-40">
            <div class="flex items-center space-x-4">
                <button id="sidebarToggle" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-xl font-semibold text-gray-800">Farmers Record Management System</h1>
            </div>
            
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <button class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </button>
                </div>
                <div class="relative">
                    <button class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-envelope text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-blue-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">5</span>
                    </button>
                </div>
                <div class="flex items-center space-x-3">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="w-8 h-8 rounded-full">
                    <span class="text-gray-700 font-medium">Admin</span>
                </div>
            </div>
        </nav>
        
        <!-- Content Area - all dashboard widgets and data displays -->
        <!-- Content Area -->
        <div class="p-6">
            <!-- Dashboard Cards - summary statistics with icons -->
            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="dashboard-card bg-white rounded-lg shadow p-6 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Total Farmers</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">1,245</p>
                        <p class="text-green-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> 12% from last month
                        </p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full">
                        <i class="fas fa-users text-green-600 text-2xl"></i>
                    </div>
                </div>
                
                <div class="dashboard-card bg-white rounded-lg shadow p-6 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Farm Lots</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">876</p>
                        <p class="text-green-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> 8% from last month
                        </p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-full">
                        <i class="fas fa-tractor text-blue-600 text-2xl"></i>
                    </div>
                </div>
                
                <div class="dashboard-card bg-white rounded-lg shadow p-6 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Crop Types</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">24</p>
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-arrow-down mr-1"></i> 2% from last month
                        </p>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-full">
                        <i class="fas fa-seedling text-yellow-600 text-2xl"></i>
                    </div>
                </div>
                
                <div class="dashboard-card bg-white rounded-lg shadow p-6 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Programs</h3>
                        <p class="text-3xl font-bold text-gray-800 mt-2">15</p>
                        <p class="text-green-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-arrow-up mr-1"></i> 5% from last month
                        </p>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-full">
                        <i class="fas fa-clipboard-list text-purple-600 text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Charts and Recent Farmers -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Farmers by Barangay Chart -->
                <div class="bg-white rounded-lg shadow p-6 lg:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Farmers Distribution by Barangay</h2>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-md">Monthly</button>
                            <button class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-md">Yearly</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="barangayChart"></canvas>
                    </div>
                </div>
                
                <!-- Recent Farmers -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Recently Registered Farmers</h2>
                        <a href="#" class="text-sm text-green-600 hover:underline">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg transition">
                            <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="Farmer" class="farmer-photo">
                            <div>
                                <h4 class="font-medium text-gray-800">Juan Dela Cruz</h4>
                                <p class="text-sm text-gray-500">Brgy. Poblacion • Rice Farmer</p>
                            </div>
                            <div class="ml-auto text-xs text-gray-400">2 days ago</div>
                        </div>
                        
                        <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg transition">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Farmer" class="farmer-photo">
                            <div>
                                <h4 class="font-medium text-gray-800">Maria Santos</h4>
                                <p class="text-sm text-gray-500">Brgy. Malino • Vegetable Farmer</p>
                            </div>
                            <div class="ml-auto text-xs text-gray-400">3 days ago</div>
                        </div>
                        
                        <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg transition">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Farmer" class="farmer-photo">
                            <div>
                                <h4 class="font-medium text-gray-800">Pedro Reyes</h4>
                                <p class="text-sm text-gray-500">Brgy. Labuad • Corn Farmer</p>
                            </div>
                            <div class="ml-auto text-xs text-gray-400">5 days ago</div>
                        </div>
                        
                        <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg transition">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Farmer" class="farmer-photo">
                            <div>
                                <h4 class="font-medium text-gray-800">Ana Mendoza</h4>
                                <p class="text-sm text-gray-500">Brgy. Taggat • Coffee Farmer</p>
                            </div>
                            <div class="ml-auto text-xs text-gray-400">1 week ago</div>
                        </div>
                        
                        <div class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg transition">
                            <img src="https://randomuser.me/api/portraits/men/65.jpg" alt="Farmer" class="farmer-photo">
                            <div>
                                <h4 class="font-medium text-gray-800">Carlos Garcia</h4>
                                <p class="text-sm text-gray-500">Brgy. Bacsay • Fruit Grower</p>
                            </div>
                            <div class="ml-auto text-xs text-gray-400">1 week ago</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Farmers Table - main data table with pagination controls -->
            <!-- Farmers Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Farmers List</h2>
                    <div class="flex space-x-3">
                        <div class="relative">
                            <input type="text" placeholder="Search farmers..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <button class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition flex items-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>Add Farmer</span>
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Farmer</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barangay</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Farm Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Farm Size</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/41.jpg" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Juan Dela Cruz</div>
                                            <div class="text-sm text-gray-500">juan.delacruz@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Poblacion</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Rice</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">2.5 hectares</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Maria Santos</div>
                                            <div class="text-sm text-gray-500">maria.santos@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Malino</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Vegetables</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">1.2 hectares</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/22.jpg" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Pedro Reyes</div>
                                            <div class="text-sm text-gray-500">pedro.reyes@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Labuad</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Corn</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">3.0 hectares</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/32.jpg" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Ana Mendoza</div>
                                            <div class="text-sm text-gray-500">ana.mendoza@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Taggat</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Coffee</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">5.0 hectares</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/65.jpg" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">Carlos Garcia</div>
                                            <div class="text-sm text-gray-500">carlos.garcia@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Bacsay</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Fruits</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">2.8 hectares</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-green-600 hover:text-green-900 mr-3"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">1,245</span> farmers
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Previous</button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700">1</button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">2</button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">3</button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Next</button>
                    </div>
                </div>
            </div>
            
            <!-- Programs and Announcements section - two column layout -->
            <!-- Programs and Announcements -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Active Programs -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Active Programs</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="p-6 hover:bg-gray-50 transition">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-green-100 p-3 rounded-full">
                                    <i class="fas fa-leaf text-green-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">Rice Competitiveness Enhancement Fund (RCEF)</h3>
                                    <p class="mt-1 text-sm text-gray-500">Provides rice farmers with farm machinery, seeds, credit, and training to improve their competitiveness.</p>
                                    <div class="mt-3 flex items-center text-sm text-gray-500">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        <span>Jan 1, 2023 - Dec 31, 2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6 hover:bg-gray-50 transition">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                                    <i class="fas fa-tractor text-blue-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">Farm Mechanization Program</h3>
                                    <p class="mt-1 text-sm text-gray-500">Distributes farm machinery and equipment to farmers' cooperatives and associations.</p>
                                    <div class="mt-3 flex items-center text-sm text-gray-500">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        <span>Ongoing</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6 hover:bg-gray-50 transition">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-full">
                                    <i class="fas fa-seedling text-yellow-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">High Value Crops Development Program</h3>
                                    <p class="mt-1 text-sm text-gray-500">Supports farmers in producing high-value crops like fruits, vegetables, and cutflowers.</p>
                                    <div class="mt-3 flex items-center text-sm text-gray-500">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        <span>Ongoing</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 text-center">
                        <a href="#" class="text-green-600 hover:text-green-800 text-sm font-medium">View all programs</a>
                    </div>
                </div>
                
                <!-- Announcements -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Announcements</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="p-6 hover:bg-gray-50 transition">
                            <div class="flex justify-between">
                                <h3 class="text-lg font-medium text-gray-900">Farmers Training on Organic Farming</h3>
                                <span class="text-xs text-gray-500">2 days ago</span>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">The DA Claveria will conduct a training on organic farming techniques on June 15-17, 2023 at the Municipal Agriculture Office.</p>
                            <div class="mt-3 flex items-center text-sm text-green-600">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <span>Municipal Agriculture Office, Claveria</span>
                            </div>
                        </div>
                        
                        <div class="p-6 hover:bg-gray-50 transition">
                            <div class="flex justify-between">
                                <h3 class="text-lg font-medium text-gray-900">Distribution of Rice Seeds</h3>
                                <span class="text-xs text-gray-500">1 week ago</span>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Registered rice farmers can claim their certified rice seeds at the MAO starting June 5, 2023. Bring your farmer's ID.</p>
                            <div class="mt-3 flex items-center text-sm text-green-600">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <span>Municipal Agriculture Office, Claveria</span>
                            </div>
                        </div>
                        
                        <div class="p-6 hover:bg-gray-50 transition">
                            <div class="flex justify-between">
                                <h3 class="text-lg font-medium text-gray-900">Farmers' Day Celebration</h3>
                                <span class="text-xs text-gray-500">2 weeks ago</span>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Join us in celebrating Farmers' Day on June 30, 2023 at the Municipal Plaza. There will be exhibits, contests, and freebies!</p>
                            <div class="mt-3 flex items-center text-sm text-green-600">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                <span>Municipal Plaza, Claveria</span>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 text-center">
                        <a href="#" class="text-green-600 hover:text-green-800 text-sm font-medium">View all announcements</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer with copyright and social links -->
        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-6 px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-sm text-gray-500 mb-4 md:mb-0">
                    © 2023 Department of Agriculture - Claveria. All rights reserved.
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-500 hover:text-gray-700">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Notification popup - appears after actions like saving -->
    <!-- Notification -->
    <div class="fixed bottom-4 right-4 z-50 hidden" id="notification">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-3 notification">
            <i class="fas fa-check-circle text-xl"></i>
            <div>
                <div class="font-medium">Success!</div>
                <div class="text-sm">Farmer record has been updated.</div>
            </div>
            <button class="ml-4" onclick="hideNotification()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    
    <!-- Add Farmer Modal - form dialog for creating new farmer records -->
    <!-- Add Farmer Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" id="addFarmerModal">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Add New Farmer</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" id="firstName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" id="lastName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" id="phone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="barangay" class="block text-sm font-medium text-gray-700 mb-1">Barangay</label>
                            <select id="barangay" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">Select Barangay</option>
                                <option value="Poblacion">Poblacion</option>
                                <option value="Malino">Malino</option>
                                <option value="Labuad">Labuad</option>
                                <option value="Taggat">Taggat</option>
                                <option value="Bacsay">Bacsay</option>
                            </select>
                        </div>
                        <div>
                            <label for="farmType" class="block text-sm font-medium text-gray-700 mb-1">Farm Type</label>
                            <select id="farmType" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">Select Farm Type</option>
                                <option value="Rice">Rice</option>
                                <option value="Corn">Corn</option>
                                <option value="Vegetables">Vegetables</option>
                                <option value="Fruits">Fruits</option>
                                <option value="Coffee">Coffee</option>
                            </select>
                        </div>
                        <div>
                            <label for="farmSize" class="block text-sm font-medium text-gray-700 mb-1">Farm Size (hectares)</label>
                            <input type="number" id="farmSize" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Farmer Photo</label>
                        <div class="mt-1 flex items-center">
                            <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Upload
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Cancel
                </button>
                <button onclick="saveFarmer()" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Save Farmer
                </button>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Main JavaScript containing all interactive functionality -->
    <script>
        // Toggle sidebar
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarToggle = document.getElementById('sidebarToggle');
        
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });
        
        // Show notification
        function showNotification() {
            const notification = document.getElementById('notification');
            notification.classList.remove('hidden');
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 5000);
        }
        
        // Hide notification
        function hideNotification() {
            document.getElementById('notification').classList.add('hidden');
        }
        
        // Open modal
        function openModal() {
            document.getElementById('addFarmerModal').classList.remove('hidden');
        }
        
        // Close modal
        function closeModal() {
            document.getElementById('addFarmerModal').classList.add('hidden');
        }
        
        // Save farmer
        function saveFarmer() {
            closeModal();
            showNotification();
        }
        
        // Barangay Chart
        const barangayCtx = document.getElementById('barangayChart').getContext('2d');
        const barangayChart = new Chart(barangayCtx, {
            type: 'bar',
            data: {
                labels: ['Poblacion', 'Malino', 'Labuad', 'Taggat', 'Bacsay', 'Centro', 'Culao'],
                datasets: [{
                    label: 'Number of Farmers',
                    data: [245, 198, 176, 154, 132, 118, 96],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(199, 199, 199, 0.6)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
        
        // Add event listener to "Add Farmer" button
        document.querySelector('button[onclick="openModal()"]').addEventListener('click', openModal);
    </script>
</body>
</html>

<script setup>
import Search from './Navbar/Search.vue';
import Link from './Sidebar/Link.vue';
import Users from './Icon/Users.vue';
import Briefcase from './Icon/Briefcase.vue';
import Applicant from './Icon/Applicant.vue';
import Report from './Icon/Report.vue';
import LinkDropdown from './Sidebar/LinkDropdown.vue';
</script>
<template>
    <aside
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidenav" id="drawer-navigation">
        <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
            <Search id="side-search" position="side"/>
            <ul class="space-y-2">
                <Link :href="route('dashboard')" text="Dashboard" :active="route().current('dashboard')">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                </Link>
                <Link :href="route('users.index')" text="Manage Users" :active="route().current('users.index')">
                    <Users/>
                </Link>
                <Link :href="route('vacancies.index')" text="Vacancies" :active="route().current('vacancies.index')">
                    <Briefcase/>
                </Link>
                <Link :href="route('vacancy.admin')" text="Manage Vacancies" :active="route().current('vacancy.admin') || route().current('vacancies.edit') || route().current('vacancies.create')">
                    <Briefcase/>
                </Link>
                <Link :href="route('applicants.index')" text="Your Applications" :active="route().current('applicants.index')">
                    <Applicant/>
                </Link>
                <Link :href="route('report.index')" text="Reporting" :active="route().current('report.index')">
                    <Report/>
                </Link>
                <!-- <LinkDropdown text="Pages">
                    <template #icon>
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </template>
                    <Link href="#" text="Menu 1" :dropdown="true"/>
                </LinkDropdown> -->
            </ul>
        </div>
    </aside>
</template>
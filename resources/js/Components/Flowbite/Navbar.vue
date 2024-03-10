<script setup>
import ApplicationLogo from './Navbar/ApplicationLogo.vue';
import Drawer from './Button/Drawer.vue';
import Search from './Navbar/Search.vue';
import DrawerNavigation from './Button/DrawerNavigation.vue';
import Dropdown from './Navbar/Dropdown.vue';

defineProps({
    user: Object
});
</script>

<template>
    <nav
        class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
        <div class="flex flex-wrap justify-between items-center">
            <div class="flex justify-start items-center">
                <Drawer />
                <ApplicationLogo />
                <Search id="top-search"/>
            </div>
            <div class="flex items-center lg:order-2">
                <DrawerNavigation />
                <Dropdown title="Notification" type="list" footerText="View all" id="notification-dropdown">
                    <template #icon>
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                            </path>
                        </svg>
                    </template>
                </Dropdown>
                <Dropdown title="Apps" type="grid" id="apps-dropdown">
                    <template #icon>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                    </template>
                </Dropdown>
                <Dropdown id="profile-dropdown" type="profile" :user="user">
                    <template #icon>
                        <img class="w-8 h-8 rounded-full"
                        :src="user.profile_photo_url"
                        alt="user photo" />
                    </template>
                </Dropdown>
            </div>
        </div>
    </nav>
</template>./Navbar/ApplicationLogo.vue
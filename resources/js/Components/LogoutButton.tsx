import { Link } from '@inertiajs/react';

export default function LogoutButton() {
    return (
        <Link
            href={route('logout')}
            method="post"
            as="button"
            className="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
        >
            Logout
        </Link>
    );
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ================================================================
        // DAFTAR SEMUA PERMISSIONS
        // Format: {Action}:{Resource}
        // ================================================================
        $permissions = [
            // ── User ──────────────────────────────────────────────────
            'ViewAny:User',
            'View:User',
            'Create:User',
            'Update:User',
            'Delete:User',
            'Restore:User',
            'RestoreAny:User',
            'Replicate:User',
            'Reorder:User',
            'ForceDelete:User',
            'ForceDeleteAny:User',

            // ── Role ──────────────────────────────────────────────────
            'ViewAny:Role',
            'View:Role',
            'Create:Role',
            'Update:Role',
            'Delete:Role',
            'DeleteAny:Role',

            // ── Post ──────────────────────────────────────────────────
            'ViewAny:Post',
            'View:Post',
            'Create:Post',
            'Update:Post',
            'Delete:Post',
            'Restore:Post',
            'RestoreAny:Post',
            'Replicate:Post',
            'Reorder:Post',
            'ForceDelete:Post',
            'ForceDeleteAny:Post',
            'Publish:Post',
            'Unpublish:Post',

            // ── Tag ───────────────────────────────────────────────────
            'ViewAny:Tag',
            'View:Tag',
            'Create:Tag',
            'Update:Tag',
            'Delete:Tag',
            'Restore:Tag',
            'RestoreAny:Tag',
            'Replicate:Tag',
            'Reorder:Tag',
            'ForceDelete:Tag',
            'ForceDeleteAny:Tag',

            // ── SambutanPimpinan ──────────────────────────────────────
            'ViewAny:SambutanPimpinan',
            'View:SambutanPimpinan',
            'Create:SambutanPimpinan',
            'Update:SambutanPimpinan',
            'Delete:SambutanPimpinan',
            'DeleteAny:SambutanPimpinan',
            'Restore:SambutanPimpinan',
            'RestoreAny:SambutanPimpinan',
            'Replicate:SambutanPimpinan',
            'Reorder:SambutanPimpinan',
            'ForceDelete:SambutanPimpinan',
            'ForceDeleteAny:SambutanPimpinan',

            // ── AgendaKegiatan ────────────────────────────────────────
            'ViewAny:AgendaKegiatan',
            'View:AgendaKegiatan',
            'Create:AgendaKegiatan',
            'Update:AgendaKegiatan',
            'Delete:AgendaKegiatan',
            'DeleteAny:AgendaKegiatan',

            // ── Data ──────────────────────────────────────────────────
            'ViewAny:Data',
            'View:Data',
            'Create:Data',
            'Update:Data',
            'Delete:Data',
            'DeleteAny:Data',

            // ── ExternalLink ──────────────────────────────────────────
            'ViewAny:ExternalLink',
            'View:ExternalLink',
            'Create:ExternalLink',
            'Update:ExternalLink',
            'Delete:ExternalLink',
            'DeleteAny:ExternalLink',

            // ── Gallery ───────────────────────────────────────────────
            'ViewAny:Gallery',
            'View:Gallery',
            'Create:Gallery',
            'Update:Gallery',
            'Delete:Gallery',
            'DeleteAny:Gallery',

            // ── Infografis ────────────────────────────────────────────
            'ViewAny:Infografis',
            'View:Infografis',
            'Create:Infografis',
            'Update:Infografis',
            'Delete:Infografis',
            'DeleteAny:Infografis',

            // ── Layanan ───────────────────────────────────────────────
            'ViewAny:Layanan',
            'View:Layanan',
            'Create:Layanan',
            'Update:Layanan',
            'Delete:Layanan',
            'DeleteAny:Layanan',

            // ── Pengaturan ────────────────────────────────────────────
            'ViewAny:Pengaturan',
            'View:Pengaturan',
            'Create:Pengaturan',
            'Update:Pengaturan',
            'Delete:Pengaturan',
            'DeleteAny:Pengaturan',

            // ── Pengumuman ────────────────────────────────────────────
            'ViewAny:Pengumuman',
            'View:Pengumuman',
            'Create:Pengumuman',
            'Update:Pengumuman',
            'Delete:Pengumuman',
            'DeleteAny:Pengumuman',

            // ── StrukturOrganisasi ────────────────────────────────────
            'ViewAny:StrukturOrganisasi',
            'View:StrukturOrganisasi',
            'Create:StrukturOrganisasi',
            'Update:StrukturOrganisasi',
            'Delete:StrukturOrganisasi',
            'DeleteAny:StrukturOrganisasi',

            // ── Visit ─────────────────────────────────────────────────
            'ViewAny:Visit',
            'View:Visit',
            'Create:Visit',
            'Update:Visit',
            'Delete:Visit',
            'DeleteAny:Visit',

            // ── Activity Log ──────────────────────────────────────────
            'ViewAny:Activity',
            'View:Activity',

            // ── Pages & Widgets ───────────────────────────────────────
            'page_Dashboard',
            'page_Logs',
            'widget_StatsOverviewWidget',
            'widget_LatestActivitiesWidget',
            'widget_AccountWidget',
            'widget_FilamentInfoWidget',
        ];

        // Buat semua permission
        foreach ($permissions as $permissionName) {
            $permissionName = trim((string) $permissionName);
            if (!empty($permissionName)) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }
        }

        $this->command->info('✅ ' . count($permissions) . ' permissions berhasil dibuat.');

        // ================================================================
        // DEFINISI ROLE
        // ================================================================
        $roles = [

            // ────────────────────────────────────────────────────────────
            // SUPER ADMIN — Bypass semua gate via AppServiceProvider
            // Gate::before akan mengembalikan true untuk role ini
            // ────────────────────────────────────────────────────────────
            [
                'name'        => 'super_admin',
                'guard_name'  => 'web',
                'description' => 'Super Administrator dengan akses penuh ke semua fitur sistem.',
                'permissions' => ['*'], // Semua permission
            ],

            // ────────────────────────────────────────────────────────────
            // ADMIN — Kelola semua konten + user, kecuali hapus role
            // dan pengaturan sistem sensitif
            // ────────────────────────────────────────────────────────────
            [
                'name'        => 'admin',
                'guard_name'  => 'web',
                'description' => 'Administrator dengan kendali penuh atas konten dan pengguna, kecuali hapus role & pengaturan sistem.',
                'permissions' => array_values(array_filter($permissions, function ($permission) {
                    // Admin tidak bisa hapus role & pengaturan sensitif
                    return !in_array($permission, [
                        'Delete:Role',
                        'DeleteAny:Role',
                        'Delete:Pengaturan',
                        'DeleteAny:Pengaturan',
                        'ForceDelete:User',
                        'ForceDeleteAny:User',
                    ]);
                })),
            ],

            // ────────────────────────────────────────────────────────────
            // MEMBER — Hanya akses dashboard & profil sendiri
            // Tidak bisa mengelola konten apapun
            // ────────────────────────────────────────────────────────────
            [
                'name'        => 'member',
                'guard_name'  => 'web',
                'description' => 'Member biasa dengan akses terbatas hanya pada dashboard dan profil sendiri.',
                'permissions' => [
                    'page_Dashboard',
                    'widget_AccountWidget',
                    'widget_StatsOverviewWidget',
                ],
            ],
        ];

        // Buat role dan assign permission
        foreach ($roles as $roleData) {
            $roleName = trim((string) ($roleData['name'] ?? ''));
            if (empty($roleName)) {
                continue;
            }

            $role = Role::firstOrCreate(
                ['name' => $roleName],
                [
                    'name'       => $roleName,
                    'guard_name' => $roleData['guard_name'] ?? 'web',
                ]
            );

            // Update description
            if (!empty($roleData['description'])) {
                $role->update(['description' => $roleData['description']]);
            }

            // Assign permissions
            $permissionsToSync = [];

            if (in_array('*', $roleData['permissions'] ?? [])) {
                // Wildcard — ambil semua permission yang sudah dibuat
                $permissionsToSync = Permission::all()->pluck('name')->toArray();
            } elseif (is_array($roleData['permissions'] ?? null)) {
                $permissionsToSync = array_values(array_filter(
                    $roleData['permissions'],
                    fn($p) => is_string($p) && !empty(trim($p))
                ));
            }

            if (!empty($permissionsToSync)) {
                $role->syncPermissions($permissionsToSync);
            }

            $count = count($permissionsToSync);
            $this->command->info("  → Role [{$roleName}]: {$count} permissions di-assign.");
        }

        $this->command->info('✅ Shield Seeding Completed.');
    }
}

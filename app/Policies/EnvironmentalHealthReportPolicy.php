<?php

namespace App\Policies;

use App\Models\EnvironmentalHealthReport;
use App\Models\User;

class EnvironmentalHealthReportPolicy
{
    /**
     * Determine if the user can view the report.
     */
    public function view(User $user, EnvironmentalHealthReport $report): bool
    {
        return true; // Semua user bisa melihat laporan lingkungan
    }

    /**
     * Determine if the user can update the report.
     */
    public function update(User $user, EnvironmentalHealthReport $report): bool
    {
        return $user->id === $report->user_id;
    }

    /**
     * Determine if the user can delete the report.
     */
    public function delete(User $user, EnvironmentalHealthReport $report): bool
    {
        return $user->id === $report->user_id;
    }
}

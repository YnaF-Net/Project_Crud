<?php

function getStatus(int $status): string
{
    return $status ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-warning">Inactive</span>';
}

// function inputFailed(int $status): string
// {
//     return $status ? '<span class="badge bg-warning">Already Exist</span>' : '<span class="badge bg-text">aseek</span>';
// }
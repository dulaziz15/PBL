<?php
namespace Pbl\Enums;

enum status: string{
    case PENDING = "Pending";
    case APPROVED = "Approved";
    case REJECTED = "Rejected";
    case PENGAJUAN = "Submit";
}
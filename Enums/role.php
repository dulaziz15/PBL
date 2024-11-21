<?php
namespace Pbl\Enums;

enum role: string {
    case SUPER_ADMIN = '1';
    case MAHSISWA = '2';
    case ADMIN_JURUSAN = '3';
    case ADMIN_PRODI = '4';
}
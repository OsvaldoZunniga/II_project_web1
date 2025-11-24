<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileUploadService
{
    /**
     * Subir imagen de perfil
     */
    public function uploadProfileImage(UploadedFile $file): string
    {
        // Verificar si es una imagen válida
        if (!$this->isValidImage($file)) {
            throw new \Exception('Archivo no válido');
        }

        // Generar nombre único
        $nuevoNombre = time() . '_' . $file->getClientOriginalName();
        
        // Asegurar que la carpeta existe
        $this->ensureAssetsDirectoryExists();
        
        // Mover archivo
        $file->move(public_path('assets'), $nuevoNombre);
        
        return 'assets/' . $nuevoNombre;
    }

    /**
     * Verificar si el archivo es una imagen válida
     */
    private function isValidImage(UploadedFile $file): bool
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        return in_array($file->getMimeType(), $allowedTypes);
    }

    /**
     * Asegurar que la carpeta assets existe
     */
    private function ensureAssetsDirectoryExists(): void
    {
        $assetsPath = public_path('assets');
        if (!is_dir($assetsPath)) {
            mkdir($assetsPath, 0755, true);
        }
    }
}
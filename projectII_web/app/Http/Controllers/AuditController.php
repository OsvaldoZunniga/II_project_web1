<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Services\AuditService;
    use App\Services\AuthService;


    class AuditController extends Controller
    {
        protected $auditService;

        public function __construct(AuditService $auditService)
        {
            $this->auditService = $auditService;
        }
        
        /**
         * Mostrar datos de auditoría
         */

        public function getAudits()
        {
            $authService = app(AuthService::class);
            $user = $authService->getAuthenticatedUser();
            $auditData = $this->auditService->getAuditData();

            return view('dashboard.main', [
                'content' => 'admin.audit',
                'auditData' => $auditData,
                'user' => $user
            ]);
        }
    }
    ?>
<?php

declare(strict_types=1);

require_once __DIR__ . '/../models/MovimientoFinanciero.php';

class FinanceController extends BaseController
{
    private MovimientoFinanciero $movimientoModel;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->movimientoModel = new MovimientoFinanciero($pdo);
    }

    /**
     * Panel principal de Caja y bancos.
     */
    public function index(): void
    {
        $this->ensureAdmin();

        $resumen = $this->movimientoModel->resumen();
        $movimientos = $this->movimientoModel->movimientos(100);

        $this->render('finance/index', [
            'title' => 'Caja y bancos',
            'cuentas' => $resumen['cuentas'],
            'totalGeneral' => $resumen['total'],
            'movimientos' => $movimientos,
        ]);
    }

    /**
     * Solo los administradores pueden acceder al panel financiero.
     */
    private function ensureAdmin(): void
    {
        $this->ensureLogged();

        if (($_SESSION['user_role'] ?? '') !== 'admin') {
            $this->error(
                'No tienes permisos para acceder a Caja y bancos.'
            );

            $this->redirect(
                'index.php?controller=mechanic&action=dashboard'
            );
        }
    }
}

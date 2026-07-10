-- =====================================================
-- WorkShop
-- Datos iniciales (Seeds)
-- =====================================================

START TRANSACTION;

-- =====================================================
-- Categorías de Inventario
-- =====================================================

INSERT INTO categorias_partes (nombre, descripcion, activo, created_at, updated_at)
VALUES
('Aceites', 'Aceites para motor y transmisión', 1, NOW(), NOW()),
('Lubricantes', 'Grasas y lubricantes especiales', 1, NOW(), NOW()),
('Filtros', 'Filtros de aceite, aire y combustible', 1, NOW(), NOW()),
('Motor', 'Repuestos del motor', 1, NOW(), NOW()),
('Transmisión', 'Caja de cambios y transmisión', 1, NOW(), NOW()),
('Embrague', 'Sistema de embrague', 1, NOW(), NOW()),
('Frenos', 'Sistema de frenos', 1, NOW(), NOW()),
('Suspensión', 'Sistema de suspensión', 1, NOW(), NOW()),
('Dirección', 'Sistema de dirección', 1, NOW(), NOW()),
('Sistema eléctrico', 'Componentes eléctricos', 1, NOW(), NOW()),
('Iluminación', 'Luces y accesorios de iluminación', 1, NOW(), NOW()),
('Baterías', 'Baterías y accesorios', 1, NOW(), NOW()),
('Refrigeración', 'Sistema de refrigeración', 1, NOW(), NOW()),
('Combustible', 'Sistema de combustible', 1, NOW(), NOW()),
('Escape', 'Sistema de escape', 1, NOW(), NOW()),
('Rodamientos', 'Rodamientos y balineras', 1, NOW(), NOW()),
('Retenes', 'Retenes y sellos', 1, NOW(), NOW()),
('Correas', 'Correas y cadenas', 1, NOW(), NOW()),
('Tornillería', 'Tornillos, tuercas y arandelas', 1, NOW(), NOW()),
('Consumibles', 'Elementos de consumo frecuente', 1, NOW(), NOW()),
('Limpieza', 'Productos de limpieza', 1, NOW(), NOW()),
('Herramientas', 'Herramientas del taller', 1, NOW(), NOW()),
('Accesorios', 'Accesorios para vehículos', 1, NOW(), NOW()),
('Otros', 'Categoría general', 1, NOW(), NOW());

COMMIT;
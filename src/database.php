<?php
function get_db_connection() {
    $db_path = __DIR__ . '/../database.sqlite';
    try {
        $pdo = new PDO('sqlite:' . $db_path);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Create table if it doesn't exist
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS items (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                description TEXT,
                category TEXT NOT NULL,
                price_per_day REAL NOT NULL,
                image_url TEXT,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            )
        ");

        // Check if table is empty and add sample data
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM items");
        $result = $stmt->fetch();
        if ($result && $result['count'] == 0) {
            $pdo->exec("
                INSERT INTO items (name, description, category, price_per_day, image_url) VALUES
                ('Ford Mustang', 'Um clássico americano de alta performance. Perfeito para um passeio de fim de semana.', 'Carro', 350.00, 'https://images.pexels.com/photos/3729464/pexels-photo-3729464.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
                ('Trailer Airstream', 'Trailer de viagem icônico e luxuoso, totalmente equipado para sua aventura.', 'Trailer', 500.00, 'https://images.pexels.com/photos/258160/pexels-photo-258160.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
                ('Escavadeira Caterpillar', 'Máquina potente para projetos de construção de grande escala.', 'Equipamento de Construção', 1200.00, 'https://images.pexels.com/photos/139386/pexels-photo-139386.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
                ('Bicicleta de Montanha', 'Ideal para trilhas e terrenos acidentados. Leve e resistente.', 'Outro', 75.00, 'https://images.pexels.com/photos/100582/pexels-photo-100582.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
                ('Volkswagen Kombi', 'Van clássica e espaçosa, perfeita para viagens em grupo com estilo retrô.', 'Carro', 250.00, 'https://images.pexels.com/photos/1637859/pexels-photo-1637859.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
                ('Betoneira', 'Equipamento essencial para misturar cimento e outros materiais em qualquer obra.', 'Equipamento de Construção', 150.00, 'https://images.pexels.com/photos/8091253/pexels-photo-8091253.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            ");
        }

        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

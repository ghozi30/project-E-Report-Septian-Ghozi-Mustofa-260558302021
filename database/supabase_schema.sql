-- 1. Tabel migrations untuk riwayat migrasi Laravel
CREATE TABLE IF NOT EXISTS migrations (
    id SERIAL PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INT NOT NULL
);

-- 2. Tabel users
CREATE TABLE IF NOT EXISTS users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP(0) WITHOUT TIME ZONE NULL,
    password VARCHAR(255) NOT NULL,
    no_whatsapp VARCHAR(255) NOT NULL DEFAULT '',
    alamat TEXT NOT NULL,
    foto VARCHAR(255) NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'warga' CHECK (role IN ('warga', 'admin')),
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE NULL,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE NULL
);
CREATE INDEX IF NOT EXISTS users_role_index ON users(role);

-- 3. Tabel password_reset_tokens
CREATE TABLE IF NOT EXISTS password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE NULL
);

-- 4. Tabel sessions (karena Vercel serverless tidak menyimpan file session lokal)
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT NULL REFERENCES users(id) ON DELETE SET NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity INT NOT NULL
);
CREATE INDEX IF NOT EXISTS sessions_user_id_index ON sessions(user_id);
CREATE INDEX IF NOT EXISTS sessions_last_activity_index ON sessions(last_activity);

-- 5. Tabel cache & locks
CREATE TABLE IF NOT EXISTS cache (
    key VARCHAR(255) PRIMARY KEY,
    value TEXT NOT NULL,
    expiration BIGINT NOT NULL
);
CREATE INDEX IF NOT EXISTS cache_expiration_index ON cache(expiration);

CREATE TABLE IF NOT EXISTS cache_locks (
    key VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration BIGINT NOT NULL
);
CREATE INDEX IF NOT EXISTS cache_locks_expiration_index ON cache_locks(expiration);

-- 6. Tabel jobs (antrean Laravel)
CREATE TABLE IF NOT EXISTS jobs (
    id BIGSERIAL PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload TEXT NOT NULL,
    attempts SMALLINT NOT NULL,
    reserved_at INT NULL,
    available_at INT NOT NULL,
    created_at INT NOT NULL
);
CREATE INDEX IF NOT EXISTS jobs_queue_index ON jobs(queue);

CREATE TABLE IF NOT EXISTS job_batches (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    total_jobs INT NOT NULL,
    pending_jobs INT NOT NULL,
    failed_jobs INT NOT NULL,
    failed_job_ids TEXT NOT NULL,
    options TEXT NULL,
    cancelled_at INT NULL,
    created_at INT NOT NULL,
    finished_at INT NULL
);

CREATE TABLE IF NOT EXISTS failed_jobs (
    id BIGSERIAL PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload TEXT NOT NULL,
    exception TEXT NOT NULL,
    failed_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX IF NOT EXISTS failed_jobs_connection_queue_failed_at_index ON failed_jobs(connection, queue, failed_at);

-- 7. Tabel laporans (data pengaduan warga)
CREATE TABLE IF NOT EXISTS laporans (
    id BIGSERIAL PRIMARY KEY,
    pelapor_id BIGINT NOT NULL REFERENCES users(id) ON DELETE RESTRICT,
    judul VARCHAR(255) NOT NULL,
    detail TEXT NOT NULL,
    tanggal DATE NOT NULL,
    foto VARCHAR(255) NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'pending' CHECK (status IN ('pending', 'proses', 'selesai')),
    created_at TIMESTAMP(0) WITHOUT TIME ZONE NULL,
    updated_at TIMESTAMP(0) WITHOUT TIME ZONE NULL
);
CREATE INDEX IF NOT EXISTS laporans_status_index ON laporans(status);
CREATE INDEX IF NOT EXISTS laporans_pelapor_id_created_at_index ON laporans(pelapor_id, created_at);

-- 8. Catat migrasi di tabel migrations
INSERT INTO migrations (migration, batch) VALUES
('0001_01_01_000000_create_users_table', 1),
('0001_01_01_000001_create_cache_table', 1),
('0001_01_01_000002_create_jobs_table', 1),
('2026_10_27_020126_create_laporans_table', 1)
ON CONFLICT DO NOTHING;

-- 9. Akun default admin (Email: admin@ereport.test | Password: AdminPassword123!)
INSERT INTO users (name, email, password, no_whatsapp, alamat, role, created_at, updated_at)
VALUES (
    'Administrator E-Report',
    'admin@ereport.test',
    '$2y$12$k0nsFo6cjfHhQ3slxjqNM.3ZcWW1BTkacdLna2Go06Beo1aeetF/G',
    '',
    '',
    'admin',
    NOW(),
    NOW()
)
ON CONFLICT (email) DO NOTHING;

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(191) NOT NULL UNIQUE,
    phone VARCHAR(20) NULL,
    password VARCHAR(255) NOT NULL,
    display_name VARCHAR(100) NOT NULL,
    avatar_url VARCHAR(500) NULL,
    bio TEXT NULL,
    status ENUM('active','suspended','deactivated','banned') DEFAULT 'active',
    is_online BOOLEAN DEFAULT false,
    last_seen_at TIMESTAMP NULL,
    email_verified_at TIMESTAMP NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    INDEX idx_users_online (is_online, last_seen_at)
);

CREATE TABLE user_settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL UNIQUE,
    theme ENUM('light','dark','system') DEFAULT 'light',
    language VARCHAR(10) DEFAULT 'en',
    notification_sound BOOLEAN DEFAULT false,
    notification_preview BOOLEAN DEFAULT false,
    read_receipts BOOLEAN DEFAULT false,
    typing_indicators BOOLEAN DEFAULT false,
    online_status_visible BOOLEAN DEFAULT false,
    two_factor_enabled BOOLEAN DEFAULT false,
    two_factor_secret VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE conversations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL UNIQUE,
    type ENUM('direct','group') DEFAULT 'direct',
    name VARCHAR(255) NULL,
    description TEXT NULL,
    avatar_url VARCHAR(500) NULL,
    created_by BIGINT UNSIGNED NULL,
    last_message_id BIGINT UNSIGNED NULL,
    last_activity_at TIMESTAMP NULL,
    is_archived BOOLEAN DEFAULT false,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    INDEX idx_conversations_activity (last_activity_at),

    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE conversation_members (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    conversation_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    role ENUM('owner','admin','member') DEFAULT 'member',
    nickname VARCHAR(100) NULL,
    is_muted BOOLEAN DEFAULT false,
    muted_until TIMESTAMP NULL,
    is_pinned BOOLEAN DEFAULT false,
    unread_count INT UNSIGNED DEFAULT 0,
    last_read_at TIMESTAMP NULL,
    last_read_message_id BIGINT UNSIGNED NULL,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    left_at TIMESTAMP NULL,
    invited_by BIGINT UNSIGNED NULL,

    UNIQUE (conversation_id, user_id),
    INDEX idx_members_user (user_id),

    FOREIGN KEY (conversation_id) REFERENCES conversations(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE messages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL UNIQUE,
    conversation_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NULL,
    reply_to_id BIGINT UNSIGNED NULL,
    type ENUM('text','image','video','audio','file','location','system','sticker') DEFAULT 'text',
    content TEXT NULL,
    metadata JSON NULL,
    is_edited BOOLEAN DEFAULT false,
    edited_at TIMESTAMP NULL,
    is_deleted BOOLEAN DEFAULT false,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,

    INDEX idx_messages_conv (conversation_id, id DESC),
    INDEX idx_messages_user (user_id),

    FOREIGN KEY (conversation_id) REFERENCES conversations(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (reply_to_id) REFERENCES messages(id) ON DELETE SET NULL
);

CREATE TABLE message_attachments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    message_id BIGINT UNSIGNED NOT NULL,
    media_file_id BIGINT UNSIGNED NULL,
    type ENUM('image','video','audio','document','sticker','gif') NOT NULL,
    url VARCHAR(1000) NOT NULL,
    thumbnail_url VARCHAR(1000) NULL,
    file_name VARCHAR(255) NULL,
    file_size INT UNSIGNED NULL,
    mime_type VARCHAR(127) NULL,
    width SMALLINT NULL,
    height SMALLINT NULL,
    duration INT UNSIGNED NULL,
    sort_order BOOLEANFAULT 0,
false   created_at TIMESTAMP NULL,

    FOREIGN KEY (message_id) REFERENCES messages(id) ON DELETE CASCADE
);

CREATE TABLE message_reactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    message_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    emoji VARCHAR(10) NOT NULL,
    created_at TIMESTAMP NULL,

    UNIQUE (message_id, user_id, emoji),

    FOREIGN KEY (message_id) REFERENCES messages(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE message_reads (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    message_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    read_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE (message_id, user_id),

    FOREIGN KEY (message_id) REFERENCES messages(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE typing_indicators (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    conversation_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    started_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NOT NULL,

    UNIQUE (conversation_id, user_id),
    INDEX idx_typing_expiry (expires_at),

    FOREIGN KEY (conversation_id) REFERENCES conversations(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE contacts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    contact_id BIGINT UNSIGNED NOT NULL,
    nickname VARCHAR(100) NULL,
    is_favorite BOOLEAN DEFAULT false,
    created_at TIMESTAMP NULL,

    UNIQUE (user_id, contact_id),

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (contact_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE blocked_users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    blocker_id BIGINT UNSIGNED NOT NULL,
    blocked_id BIGINT UNSIGNED NOT NULL,
    reason VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,

    UNIQUE (blocker_id, blocked_id),

    FOREIGN KEY (blocker_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (blocked_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE push_tokens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    token VARCHAR(500) NOT NULL,
    platform ENUM('ios','android','web') NOT NULL,
    device_name VARCHAR(200) NULL,
    is_active BOOLEAN DEFAULT false,
    last_used_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,

    INDEX idx_tokens_user (user_id, is_active),

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE media_files (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid CHAR(36) NOT NULL UNIQUE,
    uploaded_by BIGINT UNSIGNED NOT NULL,
    disk VARCHAR(50) DEFAULT 's3',
    path VARCHAR(1000) NOT NULL,
    url VARCHAR(1000) NOT NULL,
    type ENUM('image','video','audio','document','sticker','gif') NOT NULL,
    mime_type VARCHAR(127) NOT NULL,
    size INT UNSIGNED NOT NULL,
    hash CHAR(64) NULL,
    width SMALLINT NULL,
    height SMALLINT NULL,
    duration INT UNSIGNED NULL,
    is_processed BOOLEAN DEFAULT false,
    created_at TIMESTAMP NULL,

    INDEX idx_media_hash (hash),

    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE
);
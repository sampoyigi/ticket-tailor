create table users
(
    id         bigint unsigned auto_increment
        primary key,
    name        varchar(255)     not null,
    telephone        varchar(255)    not null,
    workshop        varchar(255)    not null,
    email        varchar(255)    not null,
    password        varchar(255)    not null,
    ip_address      varchar(40)      null,
    registered_at      timestamp       null,
    voucher_code      varchar(255)    null,
--     constraint users_email_unique
--         unique (email)
)
    collate = utf8mb4_unicode_ci;


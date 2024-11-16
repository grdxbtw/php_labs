-- Adminer 4.8.1 PostgreSQL 13.2 (Debian 13.2-1.pgdg100+1) dump

DROP TABLE IF EXISTS "orders";
DROP SEQUENCE IF EXISTS orders_id_seq;
CREATE SEQUENCE orders_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."orders" (
    "id" integer DEFAULT nextval('orders_id_seq') NOT NULL,
    "number" character varying(50) NOT NULL,
    "weight" numeric(10,2) NOT NULL,
    "city" character varying(100) NOT NULL,
    "delivery_type" character varying(20) NOT NULL,
    "delivery_point" character varying(100) NOT NULL,
    "created_at" timestamp DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT "orders_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "orders" ("id", "number", "weight", "city", "delivery_type", "delivery_point", "created_at") VALUES
(1,	'123',	23.00,	'8e1718f5-1972-11e5-add9-005056887b8d',	'warehouse',	'dfa949db-3f34-11ed-9eb1-d4f5ef0df2b8',	'2024-11-07 17:36:10.434523'),
(2,	'34',	21.00,	'db5c8902-391c-11dd-90d9-001a92567626',	'warehouse',	'4049830d-e1c2-11e3-8c4a-0050568002cf',	'2024-11-07 18:07:29.825598');

-- 2024-11-08 07:11:22.335005+00

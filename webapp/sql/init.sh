#!/bin/sh

set -ex
cd `dirname $0`

ISUCON_DB_HOST=${ISUCON_DB_HOST:-127.0.0.1}
#ISUCON_DB_PORT=${ISUCON_DB_PORT:-3306}
ISUCON_DB_PORT=${ISUCON_DB_PORT:-5432}
ISUCON_DB_USER=${ISUCON_DB_USER:-isucon}
ISUCON_DB_PASSWORD=${ISUCON_DB_PASSWORD:-isucon}
ISUCON_DB_NAME=${ISUCON_DB_NAME:-isuports}

# MySQLを初期化
#mysql -u"$ISUCON_DB_USER" \
#		-p"$ISUCON_DB_PASSWORD" \
#		--host "$ISUCON_DB_HOST" \
#		--port "$ISUCON_DB_PORT" \
#		"$ISUCON_DB_NAME" < init.sql

psql -U "$ISUCON_DB_USER" \
		-p "$ISUCON_DB_PASSWORD" \
		--host "$ISUCON_DB_HOST" \
		--port "$ISUCON_DB_PORT" \
		-f init.sql \
		"$ISUCON_DB_NAME"

psql -U "$ISUCON_DB_USER" \
		-p "$ISUCON_DB_PASSWORD" \
		--host "$ISUCON_DB_HOST" \
		--port "$ISUCON_DB_PORT" \
		-f postgresql/20_init.sql \
		"$ISUCON_DB_NAME"

# SQLiteのデータベースを初期化
#rm -f ../tenant_db/*.db
#cp -r ../../initial_data/*.db ../tenant_db/

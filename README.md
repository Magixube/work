# Interview

### 相關檔案
* `docker/` 存放 docker image 相關的設定
* `docker-compose.yml` 為每個 image 的設定
* `Dockerfile` 為 php + Laravel 設定
* `www/app/Enums`、`www/config/currency.php`及`www/route/api.php` 為使用於程式邏輯中的設定
* `www/app/Services/`、`www/app/Http/Controller/api` 為本次測驗主要程式邏輯

## 執行環境
```
Ubuntu 24.04.1 LTS
Docker version 24.0.7, build 24.0.7-0ubuntu4.1
PHP 8.3.6 (開發環境)
Composer version 2.8.2
```

## 使用方式
> [!NOTE]
> docker 指令請視環境需要，前面可能要加上 `sudo`

下載專案後，請先到 www 資料夾安裝專案必須的套件
```
composer install
```
於專案資料夾使用
```
docker compose up -d
```
本專案需要部份未使用資料庫，如有需要可加上
```
docker compose exec php php /var/www/artisan migrate
```

## 程式說明
### SOLID 部份
程式須符合 SOLID 原則，以下就各項說明

1. 單一功能原則：本程式所涵蓋到的物件大多僅做一件事，Service 中檢查參數與轉換的部份，在 Service 中抽象為資料處理流程，因此 Service 的功能就變成了`將接收的資料根據寫好的處理流程進行處理`
2. 開放封閉原則：如各功能有錯誤，僅須到相關類別進行調整並維持輸出。
3. 里氏替換原則：Service 中任何 Handler 皆可被符合 IHandler 介面的 Handler 替換
4. 介面隔離原則：IHandlr 不需要依賴其他功能
5. 依賴反轉原則：Service 無法完全不依賴 Factory 與 Factory 無法不依賴各 Handler，其餘部份應無直接依賴非介面類型

### 設計模式部份

1. Factory: 用於注入各轉換器的依賴
2. Adaptor: 將各個 Validator 與 Converter 包裝成 Handler，使 Service 更符合單一功能原則

## 資料庫測驗部份

### 題目一
請寫出一條查詢語句 (SQL),列出在 2023 年 5 月下訂的訂單,使用台幣付款且5月總金額最
多的前 10 筆的旅宿 ID (bnb_id), 旅宿名稱 (bnb_name), 5 月總金額 (may_amount)

Ans:
```
SELECT `bnb_id`, B.`name` as `bnb_name`, SUM(`amount`) as `may_amount` FROM `orders` A JOIN `bnbs` B ON A.`bnb_id` = B.`id` WHERE `currency` = 'TWD' AND `created_at` BETWEEN '2023-05-01 00:00:00' AND '2023-05-31 23:59:59' GROUPBY `bnb_id` ORDER BY `may_amount` DESC LIMIT 10;
 ```
 ### 題目二
在題目一的執行下,我們發現 SQL 執行速度很慢,您會怎麼去優化?請闡述您怎麼判斷與優化的方式

1. 增加 index `(currency, created_at)`：首先對上面的 SQL 進行 EXPLAIN 檢查效能會發現進行全表掃描 (type 欄位為 ALL)，而查詢條件中僅有 currency 是指定值，created_at 是一個範圍，因此將 currency 放在前面，created_at 雖然是一個範圍但加進 index 也可以稍微提昇效能

2. 此查詢看起來是統計數據，為了不影響線上功能，建議建立排程在冷門時間進行搜尋並將結果存進另外的資料表，或者一定要立刻執行則可以到備援/備份資料庫進行搜尋

3. 如果條件允許，可以將 orders 每個月的資料備份到另外一張表，如 orders_202305，減少因 created_at 增加的表搜尋時間

4. 如果這是固定每月撈取的需求，可以另外建立一張統計表欄位大致為 month, bnb, currency, total_amount，每個月每間 bnb 的 TWD 資料就是固定的一列

Finally, Thank you for taking the time to read this page.
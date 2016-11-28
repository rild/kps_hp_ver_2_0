CREATE TABLE KPS_CONCERT (
	concert_id	int	PRIMARY KEY,
	concert_name	varchar,
  concert_hall	int,
  concert_comment	varchar,
	concert_day	int,
	concert_month	int,
	concert_year	int,
  concert_begin_time_hour	int,
  concert_begin_time_min	int,
  concert_open_time_hour	int,
  concert_open_time_min	int
);

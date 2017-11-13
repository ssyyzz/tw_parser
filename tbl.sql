CREATE TABLE "tbl_parse" (
  "parse_id" serial NOT NULL,
  "parse_url" character varying NOT NULL,
  "parse_time" timestamp NOT NULL DEFAULT now(),
  "parse_type" character varying NOT NULL,
  "parse_string" character varying NULL,
  "parse_result" json NOT NULL,
  "parse_count" integer NOT NULL
);
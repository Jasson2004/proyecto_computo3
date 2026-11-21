--
-- PostgreSQL database dump
--

\restrict jL8DOPJ77xjnpJsqVHfggfo21QDK6kivud5FPxecaz3CNb85l2jqKyNL98TicLA

-- Dumped from database version 17.6 (Debian 17.6-2.pgdg13+1)
-- Dumped by pg_dump version 17.6 (Debian 17.6-2.pgdg13+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categories (
    id bigint NOT NULL,
    name character varying(100) NOT NULL,
    slug character varying(120) NOT NULL,
    description text,
    min_content_guide character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.categories OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_id_seq OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: post_images; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.post_images (
    id bigint NOT NULL,
    post_id bigint NOT NULL,
    image_path character varying(255) NOT NULL,
    participant_name character varying(120) NOT NULL,
    evidence_type character varying(255) DEFAULT 'fotografia'::character varying NOT NULL,
    caption character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT post_images_evidence_type_check CHECK (((evidence_type)::text = ANY ((ARRAY['fotografia'::character varying, 'constancia'::character varying, 'asistencia'::character varying])::text[])))
);


ALTER TABLE public.post_images OWNER TO postgres;

--
-- Name: post_images_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.post_images_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.post_images_id_seq OWNER TO postgres;

--
-- Name: post_images_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.post_images_id_seq OWNED BY public.post_images.id;


--
-- Name: post_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.post_user (
    id bigint NOT NULL,
    post_id bigint NOT NULL,
    user_id bigint NOT NULL
);


ALTER TABLE public.post_user OWNER TO postgres;

--
-- Name: post_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.post_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.post_user_id_seq OWNER TO postgres;

--
-- Name: post_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.post_user_id_seq OWNED BY public.post_user.id;


--
-- Name: posts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.posts (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    category_id bigint NOT NULL,
    title character varying(200) NOT NULL,
    slug character varying(220) NOT NULL,
    activity_date date NOT NULL,
    excerpt text,
    content text NOT NULL,
    featured_image character varying(255),
    status character varying(255) DEFAULT 'draft'::character varying NOT NULL,
    published_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT posts_status_check CHECK (((status)::text = ANY ((ARRAY['draft'::character varying, 'published'::character varying])::text[])))
);


ALTER TABLE public.posts OWNER TO postgres;

--
-- Name: posts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.posts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.posts_id_seq OWNER TO postgres;

--
-- Name: posts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.posts_id_seq OWNED BY public.posts.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    carnet character varying(15),
    role character varying(255) DEFAULT 'user'::character varying NOT NULL,
    CONSTRAINT users_role_check CHECK (((role)::text = ANY ((ARRAY['admin'::character varying, 'user'::character varying])::text[])))
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: post_images id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_images ALTER COLUMN id SET DEFAULT nextval('public.post_images_id_seq'::regclass);


--
-- Name: post_user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_user ALTER COLUMN id SET DEFAULT nextval('public.post_user_id_seq'::regclass);


--
-- Name: posts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts ALTER COLUMN id SET DEFAULT nextval('public.posts_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (id, name, slug, description, min_content_guide, created_at, updated_at) FROM stdin;
1	Ponencias	ponencias	\N	Tema, expositor, ideas centrales y aprendizajes.	2026-11-20 22:29:15	2026-11-20 22:29:15
2	Talleres	talleres	\N	Herramientas, procedimiento, práctica y resultados.	2026-11-20 22:29:15	2026-11-20 22:29:15
3	Bingo	bingo	\N	Dinámica, experiencia y participación.	2026-11-20 22:29:15	2026-11-20 22:29:15
4	Feria de proyectos	feria-de-proyectos	\N	Proyectos visitados, tecnologías e innovación.	2026-11-20 22:29:15	2026-11-20 22:29:15
5	Comelona de pizza	comelona-de-pizza	\N	Desarrollo, convivencia y experiencia.	2026-11-20 22:29:15	2026-11-20 22:29:15
6	Torneo de fútbol sala	torneo-de-futbol-sala	\N	Desarrollo, equipos y participación como jugador o espectador.	2026-11-20 22:29:15	2026-11-20 22:29:15
7	Parrillada	parrillada	\N	Descripción, convivencia y reflexión.	2026-11-20 22:29:15	2026-11-20 22:29:15
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2026_11_01_000001_add_role_to_users_table	1
5	2026_11_01_000002_create_categories_table	1
6	2026_11_01_000003_create_posts_table	1
7	2026_11_01_000004_create_post_images_and_authors_tables	1
8	2026_11_20_033742_add_search_indexes_to_posts_table	1
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: post_images; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.post_images (id, post_id, image_path, participant_name, evidence_type, caption, created_at, updated_at) FROM stdin;
3	1	posts/evidences/sJlDe55c5HBxrsFLkeApLwb5fowjbjTjb3PvpSJn.jpg	Juan Granados	fotografia	Observando y asistiendo a la inauguracion de semana de sistemas	2026-11-21 01:07:35	2026-11-21 01:07:35
4	1	posts/evidences/PfxiRtbiuCOHVMlbZegyYZ1LtVKEeJUOR96Hd1vx.jpg	Jasson Sanchez	fotografia	Observando y asistiendo a la inauguracion de semana de sistemas	2026-11-21 01:07:35	2026-11-21 01:07:35
5	2	posts/evidences/QP85DfNS17EWggPe3moXNOV6i4J63YpcZMmkXXhn.jpg	Juan Granados	fotografia	\N	2026-11-21 01:28:31	2026-11-21 01:28:31
6	2	posts/evidences/eSvQqLpsIifYMciw88VlJ6zk1YACwF7Iv31G5cmN.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 01:28:31	2026-11-21 01:28:31
7	2	posts/evidences/l1XJdfeXy05vwZoQ9uW46yjovNN4Bbu1vIGaZmJG.jpg	Juan Granados	fotografia	\N	2026-11-21 01:28:31	2026-11-21 01:28:31
8	2	posts/evidences/Yk4WS9gxwu9eQ3cdhgchbOl8WnYUOR7MSQN9EMNC.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 01:28:31	2026-11-21 01:28:31
9	2	posts/evidences/iLz8lIde7L4OIVGy0gEy33bRPBERvqDNwlPlmuKK.jpg	Juan Granados	fotografia	\N	2026-11-21 04:27:19	2026-11-21 04:27:19
10	2	posts/evidences/PNmrqbFrNz4o8FW5R5nAfV7AuJCWNrZyXulFvF3l.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 04:27:19	2026-11-21 04:27:19
11	2	posts/evidences/D2aN8KAfx5nKjeaBS28UNp6nIP3OtBxo1lv2Yf8h.jpg	Juan Granados	fotografia	\N	2026-11-21 04:27:19	2026-11-21 04:27:19
12	3	posts/evidences/gkV7hk6Uor8pfYLNGaz3zHjDB4MCPwWDlE1Borhe.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 04:49:33	2026-11-21 04:49:33
13	3	posts/evidences/feh79LYIefbrhyNhBkvi0p9c9hpXhwKyBCpphYTM.jpg	Juan Granados	fotografia	\N	2026-11-21 04:49:33	2026-11-21 04:49:33
14	3	posts/evidences/yp677ep4ltcbBQK545Lfoejil810AYBHKaoB5FKf.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 04:49:33	2026-11-21 04:49:33
15	3	posts/evidences/ZssA9MF0WvrKAc3tNxH83kOimLDptXNnu0Pvg8iF.jpg	Juan Granados	fotografia	\N	2026-11-21 04:49:33	2026-11-21 04:49:33
16	3	posts/evidences/hH9sjcIyRew3K86Sh6pMHekA23qGLoqVcAcxCYRf.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 04:49:33	2026-11-21 04:49:33
17	3	posts/evidences/oJl1YoBs647FQgjVGge8GtokGmJWUoR7IanhrGzq.jpg	Juan Granados	fotografia	\N	2026-11-21 04:49:33	2026-11-21 04:49:33
18	3	posts/evidences/0lumAF77mXZDTeeEqS2jmsqzQANiqznQ2aBuGdHN.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 04:49:33	2026-11-21 04:49:33
19	3	posts/evidences/hBqgoL3eHJlOBbbXjT8teyJp0WGciZSMfBvLu4tk.jpg	Juan Granados	fotografia	\N	2026-11-21 04:49:33	2026-11-21 04:49:33
20	3	posts/evidences/J65UmLvEZiJjcNby9GVNCBc45fuSg6l2Ckiqp8ta.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 04:49:33	2026-11-21 04:49:33
21	3	posts/evidences/F0oENF3aK3R05sS0Z93OJcWKUpWCY8V9AgSu3eBg.jpg	Juan Granados	fotografia	\N	2026-11-21 04:49:33	2026-11-21 04:49:33
22	4	posts/evidences/uOLrVMhSKboY3xUS5jHVeZoMyh0B1ObmsvJf4Fqx.jpg	Juan Granados	fotografia	\N	2026-11-21 05:31:45	2026-11-21 05:31:45
23	4	posts/evidences/XSjgsE41mbg0DPeMPdKgk6PZEjJgKVHUwznbtBae.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 05:31:45	2026-11-21 05:31:45
24	4	posts/evidences/Zkpetb0jdYpaGEOOOYd4czCsMKvc6LxymZda8s5z.jpg	Juan Granados	fotografia	\N	2026-11-21 05:31:45	2026-11-21 05:31:45
25	4	posts/evidences/nUFwPK3KAFgy04S3K4BJRiMrT54VuX1TKtGLp2Le.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 05:31:45	2026-11-21 05:31:45
26	4	posts/evidences/ZsziQapiQvcz9ZxV4ghZcHfCMmDTfNXggUTvRj6F.jpg	Juan Granados	fotografia	\N	2026-11-21 05:31:45	2026-11-21 05:31:45
27	4	posts/evidences/orYud0r7RQwY3SfpHS4LmKjVEDuVACccvbhWumig.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 05:31:45	2026-11-21 05:31:45
28	4	posts/evidences/8SRAB6y0VlT51M8m5vany22CqSlL3l0xahZimstX.jpg	Juan Granados	fotografia	\N	2026-11-21 05:31:45	2026-11-21 05:31:45
29	4	posts/evidences/dHwhbM3CyDzmpR2R8TwsFuM3A52bef2fLcSt5Pnj.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 05:31:45	2026-11-21 05:31:45
30	4	posts/evidences/JGXTVQeJsFoWSYE42qkrv6D6aHKSKW2i9k2GAkRL.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 05:31:45	2026-11-21 05:31:45
31	4	posts/evidences/fr0hm4a9CpMATZQD3dZ8Cvy6CRtUGyOFmgsVK1Nz.jpg	Juan Granados	fotografia	\N	2026-11-21 05:31:45	2026-11-21 05:31:45
32	5	posts/evidences/RTnlZWcjAS1yqyPuzv7DRwI0lGE6OWXrCRoFOAtW.jpg	Juan Granados	fotografia	\N	2026-11-21 05:59:51	2026-11-21 05:59:51
33	5	posts/evidences/ARmCg6nU0jl5f7FaFqo5OSTPf0HecpGrAk9qDjxx.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 05:59:51	2026-11-21 05:59:51
34	5	posts/evidences/DzrHBoRHZX9fJUfzJF5se6ngoPykU7tWJm6LXQLs.jpg	Juan Granados	fotografia	\N	2026-11-21 05:59:51	2026-11-21 05:59:51
35	5	posts/evidences/WaHZfBDsqaf5ipiRurR1tDagvazU2LAFMb2yb4JR.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 05:59:51	2026-11-21 05:59:51
36	5	posts/evidences/eyhLyNXL7auOqaOpthLhfuC72YF0DrQMi4sRmHIr.jpg	Juan Granados	fotografia	\N	2026-11-21 05:59:51	2026-11-21 05:59:51
37	5	posts/evidences/eYKcmIqV5HvFakwn8htoCfxopxfExYAsVfhNoopL.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 05:59:51	2026-11-21 05:59:51
38	5	posts/evidences/CL9NuQLjmfvWy0jki9LxDO6JczNnDlDSYwxBFtrY.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 05:59:51	2026-11-21 05:59:51
39	5	posts/evidences/JhDMQ5Ui9FhJavWohKAIkAfgL2VFjnFqa3BtjJqU.jpg	Juan Granados	fotografia	\N	2026-11-21 05:59:51	2026-11-21 05:59:51
40	5	posts/evidences/Ynl7IaWLvP6q4NABKAP6g1E55eITsT1GcouskI8k.jpg	Juan Granados y Jasson Sanchez	fotografia	\N	2026-11-21 05:59:51	2026-11-21 05:59:51
41	6	posts/evidences/OWXe8tE0uRFhaec9fnCIYq7hUoctwoBRyPlklGQ3.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 06:11:57	2026-11-21 06:11:57
42	6	posts/evidences/z60aRXjptCdygNzFwiaNjn2gORi3zdJh9dzdN3f3.jpg	Juan Granados	fotografia	\N	2026-11-21 06:11:57	2026-11-21 06:11:57
43	6	posts/evidences/JbxHamEg1NmdP0lffmfd89zks7rnmm4M77KNEn2V.jpg	Juan Granados	fotografia	\N	2026-11-21 06:11:57	2026-11-21 06:11:57
44	6	posts/evidences/1uquytBpozn5I7zeaBvwYwku8K6rqvCxpixPfcKe.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 06:11:57	2026-11-21 06:11:57
45	7	posts/evidences/g1dnL1jUDc5usA3ktuG4kd6m8p3f0XC27K5fLegO.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 06:25:52	2026-11-21 06:25:52
46	7	posts/evidences/IjgdkkiDc1DEQoFyFi0jsIknIfB3UDmnp0crfywV.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 06:25:52	2026-11-21 06:25:52
47	7	posts/evidences/ZSboCW9z0qDY3QDOZ64w1Vv58VT15GQuDf9WCLB8.jpg	Juan Granados	fotografia	\N	2026-11-21 06:25:52	2026-11-21 06:25:52
48	7	posts/evidences/s1Y32JIiZVvw85bRjnBpZmXQTKs2EtPiuE33zEZs.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 06:25:52	2026-11-21 06:25:52
49	7	posts/evidences/uq73f5XHucmavFBcWwz111mUEiBIW2EnBEI8HLfz.jpg	Juan Granados	fotografia	\N	2026-11-21 06:25:52	2026-11-21 06:25:52
50	8	posts/evidences/rcI9xuKZakmTyXQAHdxUmHfaEWSclhCpw9yWC8gn.jpg	Juan Granados	fotografia	\N	2026-11-21 06:42:20	2026-11-21 06:42:20
51	8	posts/evidences/ll5Kje1eaRNAN2uwi17oLgduQfXLwCAGVdi8TEvk.jpg	Juan Granados	fotografia	\N	2026-11-21 06:42:21	2026-11-21 06:42:21
52	8	posts/evidences/5o2s9ekUGzotmNabHNUP1k3rmxssqdexTMYUBtk5.png	Jasson Sanchez	fotografia	\N	2026-11-21 06:42:21	2026-11-21 06:42:21
53	10	posts/evidences/Gq4R74G9F16OH4jEkXA5sHH3kDC2nfOsOgkIujEj.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 06:59:49	2026-11-21 06:59:49
54	10	posts/evidences/Z7Hcdqg28myzJ0N6qQN25tSjLbwacGd3Cx2r2vWP.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 06:59:49	2026-11-21 06:59:49
55	10	posts/evidences/6v76wH8AwKA7tQjDEOpMKGq2plhKB3MBT4tZNzWz.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 06:59:49	2026-11-21 06:59:49
56	10	posts/evidences/J1hzNWnzUomKPkFZ28KrKNCGGE1PLSr5uBtibQwp.jpg	Juan Granados	fotografia	\N	2026-11-21 06:59:49	2026-11-21 06:59:49
57	10	posts/evidences/bz3qRHISWK7r75ZYxo16L7sb2JVMlH1GPNGN7RN2.jpg	Juan Granados	fotografia	\N	2026-11-21 06:59:49	2026-11-21 06:59:49
58	10	posts/evidences/m17l6mq3sLktFIPgPTy2DhWQxYgXhJU4HomoOCOz.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 06:59:49	2026-11-21 06:59:49
59	11	posts/evidences/9F6ZyCZDEh3SdddmSZvyd0oUMFgvgfIwXj2rxaLa.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 07:05:16	2026-11-21 07:05:16
60	11	posts/evidences/dpDk5zu70v3Q4AJs4XdQJ4GnoEKXgkOHzsSthyda.jpg	Juan Granados	fotografia	\N	2026-11-21 07:05:16	2026-11-21 07:05:16
61	11	posts/evidences/1x2vAh39xwIoo8GOuTLR3oMqnQVX6VWt3O6Cpmp2.jpg	Juan Granados	fotografia	\N	2026-11-21 07:05:16	2026-11-21 07:05:16
62	12	posts/evidences/01B6ePyc4lAUilYSsfFb0DSXtA4XL5ZnT9DXYSHn.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 07:24:03	2026-11-21 07:24:03
63	12	posts/evidences/Q1dd5NKgILuDPWka2a8FI811tk9mLAblQBLlRW0c.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 07:24:03	2026-11-21 07:24:03
64	12	posts/evidences/BUm1Fy5aThdsMbinrR70FjrNBCqywJQxL8sdkee6.jpg	Juan Granados	fotografia	\N	2026-11-21 07:24:03	2026-11-21 07:24:03
65	13	posts/evidences/9rLpTq2sZjtMnPs6b3LX7nOjp3SzMu6R1hxCFBms.jpg	Juan Granados	fotografia	\N	2026-11-21 07:33:00	2026-11-21 07:33:00
66	13	posts/evidences/SBwoL703oLavdRj3R8ArwVIY2ReOHOm5Hg9ImgS4.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 07:33:00	2026-11-21 07:33:00
67	14	posts/evidences/dgmsioaYVzL4GQJ69GE1q1aaqAr3HzEe0gHHnRPY.jpg	Jasson Sanchez	fotografia	Evidencia de Ambos	2026-11-21 07:57:00	2026-11-21 07:57:00
68	14	posts/evidences/U1lx7t8fPzmEUYyssN2AzSgbfsFMlY8N7CaReRm7.jpg	Juan Granados	fotografia	\N	2026-11-21 07:57:00	2026-11-21 07:57:00
69	14	posts/evidences/kzlqp9Xki9MCloRGQKnwfSOmiLjZ0pB5zYpnAEAm.png	Juan Granados y Jasson Sanchez	fotografia	\N	2026-11-21 07:57:00	2026-11-21 07:57:00
70	15	posts/evidences/VLa6GN3GCvHRPh36Q1GVOWgawUE1fXHgYq1AEIMq.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
71	15	posts/evidences/xZoLZRjXaNLVAVn9XwHJQZrRrIQy6Un1l6xeLAsw.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
72	15	posts/evidences/uKsqOBmKGrhlyfLzwSHbBLCaBN4UMD5RMOrMVVu3.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
73	15	posts/evidences/zVm1rr32XwvKRstjT0zYoKZ8EmqNsMDkrKJihYV6.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
74	15	posts/evidences/PsNEkAAKo08DEh4PyPXwuAQk8QzxivzGkmRErLI0.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
75	15	posts/evidences/gXDbMfSa5D3zg386TPdclFjBfT0uHLAJsk4DPvLX.jpg	Juan Granados	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
76	15	posts/evidences/w7Gv7nR7YdI4tBOryqaiG5kHxIeIN9tVZkZ7vybU.jpg	Juan Granados	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
77	15	posts/evidences/f9rjTt8yNMgdukHWZGcuEdaUS0WiAV2JnY99WdPT.jpg	Juan Granados	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
78	15	posts/evidences/ubKdxWxsGf6tPhDxXPRMGtolBQMrKLpPc4g75qbS.jpg	Juan Granados	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
79	15	posts/evidences/LvUDH1IaGcNC4tVUKq4F6vVAFhMlNMgdE5XX1yZG.jpg	Juan Granados	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
80	15	posts/evidences/q8hiuxBvCshNGpfqEWOYzCKNImRuZKElya4EJMyJ.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
81	15	posts/evidences/nBcHiI9ZeN0frCy2kxvxkyrTE731kxLGaqIA3IwF.jpg	Juan Granados y Jasson Sanchez	fotografia	\N	2026-11-21 08:11:16	2026-11-21 08:11:16
82	16	posts/evidences/QJZQZ4p8XwW2qO1O0b5aDq51CTwygWANg8f4XMfm.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 08:18:53	2026-11-21 08:18:53
83	16	posts/evidences/WsDpknJRVF8RjWbErX4bsjbOBSGfKxM0ZUyigtiE.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 08:18:53	2026-11-21 08:18:53
84	16	posts/evidences/ieLUZqHUXEQCntNYa9bwuKF9Mz1VGOUBnTVszX0L.jpg	Juan Granados	fotografia	\N	2026-11-21 08:18:53	2026-11-21 08:18:53
85	16	posts/evidences/5fiW2JBebwsPX9HvXtwq8huSUTxfvxYRKJkddVv6.jpg	Jasson Sanchez	fotografia	\N	2026-11-21 08:21:30	2026-11-21 08:21:30
\.


--
-- Data for Name: post_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.post_user (id, post_id, user_id) FROM stdin;
1	1	1
2	1	2
3	2	2
4	2	1
5	3	2
6	3	1
7	4	2
8	4	1
9	5	2
10	5	1
11	6	2
12	6	1
13	7	2
14	7	1
15	8	2
16	8	1
17	9	2
18	9	1
19	10	2
20	10	1
21	11	2
22	11	1
23	12	2
24	12	1
25	13	2
26	13	1
27	14	2
28	14	1
29	15	2
30	15	1
31	16	2
32	16	1
\.


--
-- Data for Name: posts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.posts (id, user_id, category_id, title, slug, activity_date, excerpt, content, featured_image, status, published_at, created_at, updated_at) FROM stdin;
1	1	1	Inauguración de Semana de Sistemas	inauguracion-ponencia-ia-2026	2026-11-16	El lunes 16 de noviembre de 2026, a las 8:00 a. m., se realizó la inauguración de la Semana de Sistemas 2026 en el Auditorio 1 de la FMO.\r\n\r\nEl evento comenzó c...	El lunes 16 de noviembre de 2026, a las 8:00 a. m., se realizó la inauguración de la Semana de Sistemas 2026 en el Auditorio 1 de la FMO.\r\n\r\nEl evento comenzó con la presentación de la mesa de honor, sus discursos y Las actividades estuvieron a cargo del estudiante Adán Quevedo.\r\n\r\nReflexión de nosotros: La inauguración nos permitió ver que la Semana de Sistemas es un espacio para aprender y también para convivir con compañeros, docentes e invitados de la facultad. Escuchar los discursos nos recordó que lo que estudiamos en clase se conecta con proyectos y problemas reales, y que este año el tema de tecnología sostenible con IoT va en esa dirección. Salimos con interés por las ponencias y actividades del resto de la semana, y con ganas de aprovecharlas.	posts/featured/vmTz3c0b5dr7YaMbg1SmasAkA26KUn6A1H6vfVAm.jpg	published	2026-11-20 22:29:15	2026-11-20 22:29:15	2026-11-21 07:26:28
2	1	1	Ponencia #1 : Investigacion aplicada en IOT, para la agroindustria en El Salvador	poencia-1-investigacion-aplicada-en-iot-para-la-agroindustria-en-el-salvador-qG3eR	2026-11-16	Ponencia #1 : Dia lunes 16 de noviembre,  Lugar: Auditorio 1, 10:00 a. m - 12:00 pm.\r\nTema: Del internet de las Cosas a la investigación aplicada.\r\nExpositor: O...	Ponencia #1 : Dia lunes 16 de noviembre,  Lugar: Auditorio 1, 10:00 a. m - 12:00 pm.\r\nTema: Del internet de las Cosas a la investigación aplicada.\r\nExpositor: Otoniel Flores-Cortez\r\nIdeas centrales: ¿Qué es realmente el IOT?, ¿Paso para llegar del prototipo a la evidencia?\r\nAprendizajes:\r\nRedefiniendo el IoT: Comprendimos que el Internet de las Cosas no es solo conectar aparatos por moda o ensamblar hardware funcional, sino estructurar una arquitectura de 5 capas (Percepción, Nodo/Edge, Red, Plataforma y Aplicación) pensada para convertir fenómenos físicos en evidencia científica y datos trazables.\r\n\r\nEl problema de la brecha tecnológica agrícola: Analizamos el contexto salvadoreño, donde operar a ciegas o con un monitoreo discontinuo (como visitas semanales) genera datos incompletos y lleva a los productores a tomar decisiones basadas enteramente en la intuición empírica y la alta vulnerabilidad climática.\r\n\r\nLa ruta crítica de la investigación: Descubrimos que el hardware construido es solo el punto de partida. La verdadera investigación aplicada exige una ruta de 5 pasos: 1) Requisitos, 2) Prototipo (diseño e implementación), 3) Verificación en laboratorio, 4) Validación de aptitud en campo, y 5) Evaluación en contexto.\r\n\r\nElección de tecnología con criterio: Aprendimos que la selección de conectividad (Wi-Fi, Bluetooth/BLE, LoRa/LPWAN o celular) no debe dictarse por la popularidad comercial, sino por el análisis comparativo del alcance, tasa de datos, consumo energético y la topografía real del terreno\r\n\r\nReflexión de nosotros: Esta ponencia nos mostró que investigar en tecnología va más allá de armar un prototipo que funcione en el laboratorio. Lo importante es generar conocimiento que pueda comprobarse. Entendimos que, en proyectos de IoT para la agricultura, los sensores deben medir lo que realmente ocurre en el campo y estar validados, y que el sistema debe seguir funcionando aunque falle la conexión, guardando los datos y enviándolos después. Nos llevamos la idea de que una buena solución se basa en evidencia constante y no solo en la intuición.	posts/featured/RI5KdEdeEtnPayAU01esxxBzseW0BqTAor2T27Ap.jpg	published	2026-11-21 01:28:30	2026-11-21 01:28:30	2026-11-21 07:25:37
3	1	1	Ponencia #2: Energias Alternativas y eficiencia energetica	ponencia-2-energias-alternativas-y-eficiencia-energetica-zEWnJ	2026-11-16	Tema: Energías alternativas y eficiencia energética.\r\nExpositor: Dr. Carlos Osmin Pocasangre Jiménez.\r\nIdeas centrales: el expositor habló de la importancia de...	Tema: Energías alternativas y eficiencia energética.\r\nExpositor: Dr. Carlos Osmin Pocasangre Jiménez.\r\nIdeas centrales: el expositor habló de la importancia de medir para gestionar el consumo de energía, de los beneficios de la eco-eficiencia, de cómo está compuesta la matriz eléctrica del país y de las nuevas apuestas por tecnologías limpias.\r\n\r\nAprendizajes:\r\n\r\n- Medir para gestionar: partió de la frase atribuida al filósofo William Pepperell Montague, "lo que no se puede medir, no se puede gestionar". Entendimos que cualquier plan de ahorro de energía empieza por medir cuánto se consume realmente.\r\n\r\n- Beneficios de la eficiencia energética: las soluciones eco-energéticas no solo bajan la factura eléctrica. También mejoran el confort y la calidad de vida, cuidan el medio ambiente, duran en el tiempo y se relacionan con los Objetivos de Desarrollo Sostenible (ODS).\r\n\r\n- Buenas prácticas frente a la improvisación: con ejemplos de la vida diaria, algunos graciosos, vimos que una mala instalación o una solución improvisada en climatización hace que se desperdicie mucha energía. Por eso son necesarios un buen diseño y una buena técnica.\r\n\r\n- Panorama energético de El Salvador: revisamos datos oficiales de generación eléctrica de la SIGET y conocimos proyectos y tendencias del país, desde soluciones pequeñas como los biodigestores domésticos Homebiogas, hasta estudios de gran escala sobre hidrógeno verde y energía nuclear.\r\n\r\nReflexión de nosotros: Esta charla nos dejó claro que la sostenibilidad y el paso hacia energías limpias no son asuntos que solo competen a las grandes centrales eléctricas. Todo comienza con algo simple: saber cuánta energía consumimos y sacarle más provecho en los sitios donde estudiamos, trabajamos y vivimos. Mientras el país analiza alternativas de gran escala como el hidrógeno verde, el biogás o la energía nuclear, a nosotros, como futuros profesionales y ciudadanos, nos corresponde disminuir el derroche en el día a día y buscar una eficiencia verdadera. Cada kilovatio bien utilizado aporta a la economía y también al cuidado del medio ambiente.	posts/featured/uc1to8ivSi7iXE0sv06vQ1AodlNwg43PxheWrbNJ.jpg	published	2026-11-21 04:49:33	2026-11-21 04:49:33	2026-11-21 07:24:27
4	1	1	Ponencia #3: Eficencia Energética, Optimización de recursos y sostenibilidad aplicada a soluciones tecnológicas	ponencia-3-eficencia-energetica-optimizacion-de-recursos-y-sostenibilidad-aplicada-a-soluciones-tecnologicas-u1MYX	2026-11-17	Lugar: Auditorio 1, 8:00 a. m - 10: 00 a.m.\r\nTema: Eficiencia energética, optimización de recursos y sostenibilidad aplicada a soluciones tecnológicas (Automati...	Lugar: Auditorio 1, 8:00 a. m - 10: 00 a.m.\r\nTema: Eficiencia energética, optimización de recursos y sostenibilidad aplicada a soluciones tecnológicas (Automatización de aires acondicionados mediante IoT, BACnet e IA).\r\nExpositor: Lic. Nahum Sánchez.\r\nIdeas centrales: en esta charla se explicó hasta dónde llega el IoT en la industria, que va mucho más allá de las placas de desarrollo, cómo se comunican los equipos usando protocolos abiertos como BACnet, y cómo un sistema puede pasar de solo registrar datos a anticipar lo que va a ocurrir con ayuda de la Inteligencia Artificial.\r\n\r\nAprendizajes:\r\n\r\n- El IoT no es solo Arduino: vimos que también incluye equipos reales de uso industrial, como aires acondicionados, medidores, bombas y luminarias. Todos funcionan con la misma lógica de tres pasos: primero miden con sensores, luego transmiten la información por medio de gateways y protocolos, y al final un software decide y ordena a los actuadores qué hacer.\r\n\r\n- Cómo se entienden las máquinas entre sí: conocimos la diferencia entre Modbus y BACnet. Modbus entrega los datos como números en registros, y hace falta consultar un manual para saber qué significa cada uno. BACnet, en cambio, los presenta como objetos con nombre, tipo y unidad, por ejemplo "Temp. zona 2 = 24.5 °C", así que se explican solos. El gateway hace de traductor en tiempo real, parecido a lo que hace el JIT en .NET.\r\n\r\n- Subir de nivel, de medir a predecir: nos explicaron que un sistema de control puede crecer en tres etapas. La primera es la estadística básica, con promedios y gráficos por zona. La segunda es el Machine Learning, que permite predecir comportamientos y detectar anomalías. La tercera usa modelos de lenguaje para dar órdenes al sistema escribiéndolas como lo haríamos al hablar.\r\n\r\n- Control centralizado y ahorro: nos mostraron una aplicación hecha en .NET desde la que se programan los horarios de encendido, se fijan límites de temperatura y se vigilan las zonas en tiempo real. También envía alertas cuando algo falla y garantiza que todo quede apagado los fines de semana. Con eso se logra el mismo confort usando los equipos muchas menos horas.\r\n\r\nReflexión de nosotros: Esta ponencia conecta de forma muy práctica lo que vemos en clase sobre programación con la ingeniería que se usa en el mundo real. Entender que un gateway trabaja con la misma lógica de un intérprete en tiempo real, o que usar estándares abiertos como BACnet evita depender del lenguaje propio de cada fabricante, cambió nuestra forma de ver el trabajo de un desarrollador. Concluimos que el Green IoT no pide renunciar a la comodidad de las personas. Lo que busca es usar software inteligente, buenos protocolos e IA para acabar con el desperdicio de energía que casi nadie nota.	posts/featured/4gkhXJt9J4xWqnPGuL5FF7Y6J2V5Jpyg7q4Trmxw.jpg	published	2026-11-21 05:31:45	2026-11-21 05:31:45	2026-11-21 07:25:14
5	1	1	Ponencia #4 Ciberseguridad	ponencia-4-ciberseguridad-7uVnp	2026-11-17	Lugar: Auditorio 1. 10:00 a.m. - 12:00 a. m.\r\n\r\nTema: Ciberseguridad, nuevos riesgos de la Inteligencia Artificial y simulación interactiva de un ciberataque (E...	Lugar: Auditorio 1. 10:00 a.m. - 12:00 a. m.\r\n\r\nTema: Ciberseguridad, nuevos riesgos de la Inteligencia Artificial y simulación interactiva de un ciberataque (ESET El Salvador).\r\n\r\nExpositores: Victoria Rivas y Edwin Umaña\r\nIdeas centrales: la charla habló de la distancia entre lo rápido que se está adoptando la IA y lo poco que se regula su uso, de los nuevos riesgos que esto trae para la seguridad informática, de buenas prácticas para protegernos y de una demostración en vivo de cómo se desarrolla una intrusión.\r\n\r\nAprendizajes:\r\n\r\n- La IA va más rápido que las reglas para usarla: con datos del Data Breach Investigations Report 2025 de Verizon Business, vimos que el uso de IA personal sin control es mucho mayor que el de herramientas integradas y reguladas (70 % frente a 15 %). Eso deja puntos ciegos y provoca filtraciones de datos, tanto en la academia como en las empresas.\r\n\r\n- Nuevos riesgos con la IA: la Inteligencia Artificial no solo ayuda a mejorar procesos, también trae amenazas que antes no existían. Por eso hay que repensar cómo protegemos la información y qué datos compartimos con estas herramientas.\r\n\r\n- Un ataque en vivo: participamos en una simulación interactiva dirigida por ESET El Salvador, donde se mostró paso a paso cómo avanza un ataque: escaneo de la red, búsqueda de puertos abiertos, hallazgo de credenciales expuestas en repositorios de GitHub y robo de sesión. Desde nuestros dispositivos votamos para distinguir los correos de phishing de las alertas legítimas y decidir si el ataque seguía adelante.\r\n\r\n- Contraseñas que sí resisten: vimos por qué son tan débiles las claves basadas en datos personales, como el nombre de una mascota y un año, sobre todo si se repiten en la universidad, el correo y GitHub, o se guardan sin protección en el navegador. La alternativa es usar frases largas y fáciles de recordar (por ejemplo, pupusas-lunes-volcan-7), un gestor de contraseñas y la verificación en dos pasos o las passkeys.\r\n\r\nReflexión de nosotros: Esta ponencia dejó una advertencia clara, y la simulación en vivo la hizo aún más real: en ciberseguridad, el factor humano sigue siendo el punto más débil. Ahora, con el uso masivo de herramientas de inteligencia artificial, muchas veces no pensamos en los riesgos que conlleva compartir datos, ni en quién controla esa información. Vimos en tiempo real cómo un descuido común puede abrir la puerta a un ataque: dejar una contraseña en un repositorio antiguo de GitHub, usar contraseñas sencillas o caer en un correo falso. Eso nos mostró que la seguridad no depende solo de tecnologías complejas. Lo más importante es revisar con atención cada enlace, cada notificación y cuidar nuestros hábitos digitales. Ese es nuestro mejor escudo contra los riesgos en línea.	posts/featured/Vh5OJu1zW4Lxg3rQPQsGPZxDNzXCV0eM3YucBesf.jpg	published	2026-11-21 05:59:51	2026-11-21 05:59:51	2026-11-21 05:59:51
6	1	2	Taller: Sostenibilidad y Analisis energetico mediante Electricity Maps	taller-sostenibilidad-y-analisis-energetico-mediante-electricity-maps-GD3bA	2026-11-17	Lugar: Auditorio 1, 1:00 p. m. - 4:00 p. m.\r\nExpositor: Br. Josué González\r\nHerramientas: usamos dos plataformas web. La primera fue Electricity Maps, que muest...	Lugar: Auditorio 1, 1:00 p. m. - 4:00 p. m.\r\nExpositor: Br. Josué González\r\nHerramientas: usamos dos plataformas web. La primera fue Electricity Maps, que muestra en tiempo real la intensidad de carbono y la mezcla eléctrica de distintos países. La segunda fue Electricity Lab, un entorno web creado por el expositor para usar la API de Electricity Maps con una API Key. Tiene un Playground, tutoriales y casos prácticos.\r\n\r\nProcedimiento: la sesión fue expositiva y demostrativa. Primero recorrimos la interfaz de Electricity Maps para entender cómo se miden y se muestran indicadores como la intensidad de carbono, la mezcla eléctrica, el porcentaje de energía renovable y el potencial eólico en distintas regiones del mundo, con ejemplos de El Salvador. Después se presentó cómo está organizado Electricity Lab y cómo hacer peticiones GET a los endpoints de la API, que responden en formato JSON, para automatizar el cálculo de emisiones.\r\n\r\nPráctica: se revisó la sección Práctica Green IoT de Electricity Lab, pensada para resolver casos de estimación de emisiones de equipos eléctricos en unos 35 minutos, y se mostró cómo funciona el Playground de la API. La demostración se enfocó en recorrer la herramienta y explicar cómo se consumen los datos, sin hacer un ejercicio guiado paso a paso en vivo. Al final quedó habilitado el entorno para que cada quien pudiera hacer consultas y pruebas por su cuenta.\r\n\r\nResultados: entendimos cómo se obtienen y se analizan datos de energía en tiempo real con APIs abiertas, y cómo consultar la huella de carbono de la red eléctrica de El Salvador y de otros países. Esa información sirve de base para proyectos de Green IoT y de sostenibilidad digital.\r\n\r\nReflexión de nosotros: Este taller nos ayudó a entender la sostenibilidad digital de una manera técnica y medible. Normalmente pensamos que el impacto ambiental de la tecnología no se ve. Sin embargo, herramientas como Electricity Maps y su API demuestran que cada kilovatio hora que consumen nuestros sistemas deja una huella de carbono concreta. Además, esa huella cambia según la hora del día y según cómo cada país produce su electricidad. Con plataformas como Electricity Lab, los estudiantes de informática podemos incluir el cuidado del ambiente en lo que desarrollamos. Por ejemplo, podemos programar las tareas pesadas o los procesos de IoT para las horas en que la energía es menos contaminante. De esta forma entendimos que la eficiencia energética también se construye desde el código y el análisis de datos.	posts/featured/J5mu7acAmU22PVkqTIiDRwiWw3EF4m6Y7D69YKv9.jpg	published	2026-11-21 06:11:57	2026-11-21 06:11:57	2026-11-21 06:11:57
7	1	3	Bingo	bingo-YN1pc	2026-11-18	Lugar: Auditorio 1, desde las 8:00 a. m en adelante\r\nDinámica: estudiantes de cuarto año de la carrera presentaron un juego de bingo hecho como aplicación web,...	Lugar: Auditorio 1, desde las 8:00 a. m en adelante\r\nDinámica: estudiantes de cuarto año de la carrera presentaron un juego de bingo hecho como aplicación web, y lo usamos para jugar entre todos los asistentes.\r\nExperiencia: fue una actividad muy divertida. En el juego participábamos para ganar premios y el ambiente fue animado durante toda la dinámica.\r\nParticipación: jugaron varias rondas de bingo y hubo otras actividades y dinámicas  en las que también se podían ganar premios\r\n\r\nReflexión de nosotros: Ver que un programador de cuarto año hizo un juego web tan sencillo como un bingo y que con eso llenó el auditorio de risas y diversión nos dejó una buena enseñanza. No hace falta crear algo muy complejo para que el software sea útil: una idea simple, bien hecha, puede juntar a mucha gente y hacerla pasar un buen rato. También nos motivó a pensar en lo que nosotros podremos crear cuando lleguemos a cuarto año.	posts/featured/wHWiNILUMwknJZQf5Zvt6eZqkxv6CoeH7KjzNXHS.jpg	published	2026-11-21 06:25:52	2026-11-21 06:25:52	2026-11-21 06:25:52
8	1	4	Asistencia y Ayuda armando Canopis para la feria de logros	asistencia-y-ayuda-armando-canopis-para-la-feria-de-logros-RlQep	2026-11-18	En el caso del estudiante Jasson, el fue a traer los canopis a los lugares asignados, y el estudiante Juan, ayudo a la hora de armarlos para la feria de logros	En el caso del estudiante Jasson, el fue a traer los canopis a los lugares asignados, y el estudiante Juan, ayudo a la hora de armarlos para la feria de logros	posts/featured/XXbslv5sxuzUaSaI1AkAeyWWDV23icNtYN5mjhu3.jpg	published	2026-11-21 06:42:20	2026-11-21 06:42:20	2026-11-21 06:42:20
9	1	4	Feria de Logros	feria-de-logros-z9DP4	2026-11-19	Lugar: Plaza Minerva, 8:00 a. m 12 : 00 p .m.\r\nProyectos visitados: Varios proyectos visitados que se publicaran en los siguientes post de manera individual	Lugar: Plaza Minerva, 8:00 a. m 12 : 00 p .m.\r\nProyectos visitados: Varios proyectos visitados que se publicaran en los siguientes post de manera individual	posts/featured/nQOjRxREHwhzSxHtQYUGIUY9ugOfjimRwRQWpYOL.png	published	2026-11-21 06:50:06	2026-11-21 06:50:06	2026-11-21 06:50:06
10	1	4	Proyecto #1 Futbol Collector	proyecto-1-futbol-collector-2nD05	2026-11-19	Titulo: Card collector (proyecto del integrante Juan Anderson Granados)\r\nTecnologías: HTML, JS, CS Y ASTRO\r\nIdea central del proyecto : Tener una web donde pued...	Titulo: Card collector (proyecto del integrante Juan Anderson Granados)\r\nTecnologías: HTML, JS, CS Y ASTRO\r\nIdea central del proyecto : Tener una web donde puedas ver resultados en vivo, tablas de clasificación de los equipos que sigas, colección de figuritas, ver partidos en vivo y jugar minijuegos de manera local o multijugador 2c2.	posts/featured/hOX4BJHkck05gHQMdzJOmgBTjPwlMt6sGQWdWZ5q.jpg	published	2026-11-21 06:59:49	2026-11-21 06:59:49	2026-11-21 06:59:49
11	1	4	Proyecto #2 BASTA	proyecto-2-basta-cB0Ig	2026-11-19	Nombre del proyecto: BASTA\r\nEste proyecto es una aplicación movil inspirada en el tradicional juego Bachillerato Stop.\r\nProyecto visitado: Basta presentado por...	Nombre del proyecto: BASTA\r\nEste proyecto es una aplicación movil inspirada en el tradicional juego Bachillerato Stop.\r\nProyecto visitado: Basta presentado por estudiantes de cuarto año de la carrera.\r\n\r\nTecnologías: es una aplicación móvil hecha con programación de dispositivos móviles en el lenguaje Java.\r\n\r\nDescripción: la aplicación está inspirada en el juego tradicional de Bachillerato (Stop), en el que se ponen a prueba el vocabulario, la rapidez para pensar y la memoria para recordar palabras. El juego funciona así:\r\n\r\n- Se elige una letra del abecedario y hay que completar varias categorías con palabras que empiecen con esa letra.\r\n- Cada jugador trata de completar todas las categorías antes que los demás.\r\n- El primero en terminar presiona el botón BASTA.\r\n- Se comparan las respuestas de todos los jugadores.\r\n- Las respuestas válidas y que no se repiten reciben más puntos.\r\n- Al final gana quien tenga más puntos acumulados.	posts/featured/hH4sOob1pjSkRO6p1exx50WwqWtLl9wmShWrl15I.png	published	2026-11-21 07:05:15	2026-11-21 07:05:15	2026-11-21 07:05:15
12	1	4	Proyecto #3 Sistema de velocimetro inteligente para bicis	proyecto-3-sistema-de-velocimetro-inteligente-para-bicis-2jlh4	2026-11-19	Nombre del proyecto: sistema de velocimetro inteligente para bicicleta\r\nEstudiante: Manuel Alejandro Solano Guzman\r\nTecnologías: es un prototipo físico instalad...	Nombre del proyecto: sistema de velocimetro inteligente para bicicleta\r\nEstudiante: Manuel Alejandro Solano Guzman\r\nTecnologías: es un prototipo físico instalado directamente sobre una bicicleta. Su circuito usa un sensor Hall magnético KY-003, un sensor Hall lineal KY-024, un sensor de mercurio KY-017 y dos imanes. Todos están conectados con cables a una unidad de control colocada en el manubrio. La lógica del proyecto se programó en el entorno Arduino IDE.\r\n\r\nInnovación: lo más novedoso del sistema es que monitorea varias cosas a la vez. No solo mide la velocidad: también registra la cadencia de pedaleo y detecta caídas, lo que agrega una función de seguridad para quien usa la bicicleta.\r\n\r\nReflexión de nosotros: La feria nos mostró que la inteligencia de un programador no se queda solo en el código. También está en los circuitos y en las ideas que pueden cambiar nuestro país. Ver una aplicación móvil hecha por estudiantes de tercer año junto a un prototipo con sensores instalado en una bicicleta nos dejó claro que desarrollar software y construir equipos pueden ir de la mano, y que los proyectos de nuestra misma facultad pueden ser útiles en la vida real.	posts/featured/KWvG5IOOs3Z8jooxEqMQlnZE0o04b4ZjxJh1S3sN.jpg	published	2026-11-21 07:24:03	2026-11-21 07:24:03	2026-11-21 07:24:03
13	1	4	Proyecto #4 Sistema de Monitor Solar	proyecto-4-sistema-de-monitor-solar-Msq9l	2026-11-19	Proyecto visitado: Sistema de monitor solar, del área de Energía.\r\nAutor: Jairo Ortiz\r\n\r\nTecnologías: el prototipo usa un sensor de voltaje, un sensor de balanc...	Proyecto visitado: Sistema de monitor solar, del área de Energía.\r\nAutor: Jairo Ortiz\r\n\r\nTecnologías: el prototipo usa un sensor de voltaje, un sensor de balancín y un panel solar pequeño. Todos están conectados con cables a una protoboard y a un microcontrolador, que se programó en Arduino IDE para definir cómo funciona el sistema.\r\n\r\nInnovación: lo más novedoso es para qué sirve. El sistema mide el voltaje que produce el panel según cuánto esté inclinado, y así permite ver de forma física cómo el ángulo del panel cambia la eficiencia con que capta la energía.\r\n\r\nReflexión de nosotros:Como futuros ingenieros, podemos aprovechar la naturaleza y el medio ambiente en nuestros proyectos y llevarlos al campo del IoT. El monitor solar nos mostró un ejemplo: con un panel pequeño y unos sensores se puede medir cuánta energía produce el sol según la posición del panel, y esa información sirve para usar mejor los recursos naturales.	posts/featured/kb1jA6Y5dQd8gaZePpc4xOwisVtFqEqaYOhBFeC0.jpg	published	2026-11-21 07:33:00	2026-11-21 07:33:00	2026-11-21 07:33:00
14	1	5	Comelona de Pizza	comelona-de-pizza-WACZd	2026-11-20	Lugar: La plaza minerva , 12 pm \r\nDesarrollo: 5 participantes: y premios para el ganador\r\nConvivencia: estudiantes de toda la carrera se reunieron para animar a...	Lugar: La plaza minerva , 12 pm \r\nDesarrollo: 5 participantes: y premios para el ganador\r\nConvivencia: estudiantes de toda la carrera se reunieron para animar al Ing. Guandique y apoyarlo durante la competencia.\r\n\r\nExperiencia: fue muy divertido ver cómo los concursantes daban todo de sí, aunque al final el Ing. Guandique volvió a ganar, por segundo año seguido, con un récord de una caja de pizza en 7 minutos.	posts/featured/V68V0mZsHT3j1cOKZe74riTLAUAcZT58Ya4p0EJb.jpg	published	2026-11-21 07:57:00	2026-11-21 07:57:00	2026-11-21 07:57:00
15	1	6	Torneo de Futsal	torneo-de-futsal-7sN9m	2026-11-20	Lugar: Cancha de futsal detras de biblioteca, hora 8:00 am\r\nDesarrollo: Torneo donde 7 equipos disputaron partidos para ver el campeón\r\nEquipos: Junta directiva...	Lugar: Cancha de futsal detras de biblioteca, hora 8:00 am\r\nDesarrollo: Torneo donde 7 equipos disputaron partidos para ver el campeón\r\nEquipos: Junta directiva, Manchester Rojo, Legion 7, Token FC, Jeffrey y sus amigos, Industriales, Dockercompose.yml\r\nParticipacion de los estudiantes (Espectadores)\r\nGanador del torneo : Jeffrey y sus amigos\r\n\r\nReflexion de nosotros: La diversión y la convivencia que se viven con el fútbol van más allá de las carreras. Nos juntan a todos como personas y como hermanos, y eso es lo que más valoramos de este torneo.	posts/featured/FMQu97Y0asx4TuknwfolVnxyRsRmuL7O6RHRTDge.jpg	published	2026-11-21 08:11:15	2026-11-21 08:11:15	2026-11-21 08:11:15
16	1	7	Parrillada	parrillada-K4S0O	2026-11-20	Lugar: Alrededores de la cancha, 11:45 p. m. en adelante\r\nDescripción: Carne asada al aire libre\r\nConvivencia: Reunión y almuerzo con un plato de carne preparad...	Lugar: Alrededores de la cancha, 11:45 p. m. en adelante\r\nDescripción: Carne asada al aire libre\r\nConvivencia: Reunión y almuerzo con un plato de carne preparado por el Ing. Diego y alumnos de 4.º año\r\n\r\nReflexion de nosotros: Para cerrar la Semana de Sistemas, la parrillada nos dejó claro que la convivencia está por encima de las ocupaciones de cada quien. Ver al Ing. Diego cocinando y estar todos juntos en el almuerzo fue una forma sencilla y muy bonita de terminar la semana	posts/featured/iz2FHMxPhvgH0TFGQe41U9S8bxT7H64biRRKLUd4.jpg	published	2026-11-21 08:18:53	2026-11-21 08:18:53	2026-11-21 08:21:30
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
YVDBcEVKb3D3fJ0cYImBqaDopCjM3SfyNq6FCXf0	1	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 OPR/139.0.0.0	YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTGJPV21KcE1xN0Z6ZDZoakN6cWFlbjBXWm1JNlFXOUpueGZLVE5vaiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6ImJmYzQyMmMxNTk2OWU4MmI1ZGE0NTg0YTRjMGVlYjdlNjEwZGI4YzQ1ZTA2MmMwYTdlN2Y1M2NiYTk5MWNhM2UiO30=	1795291798
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, carnet, role) FROM stdin;
1	Juan Granados	ga22021@ues.edu.sv	\N	$2y$12$JQv70xtP8.92egVNQ6Y7F.rKT5ryD3D6.1lYn.5.LojoHdt0wOMxi	\N	2026-11-20 22:29:15	2026-11-20 22:29:15	GA22021	admin
2	Jasson Sanchez	sp23001@ues.edu.sv	\N	$2y$12$FlSLvZPUnIaY4ShnAvjS6OIuQSHXhScO5PmJbY1Rcwbw9s2AMgZYK	\N	2026-11-20 22:29:15	2026-11-20 22:29:15	SP23001	admin
3	Estudiante Visitante	usuario@ues.edu.sv	\N	$2y$12$zdVuff./LxnbWaHRr7lnceDrHujsuXwmbgHTmKBI.pycoVcEV4i76	\N	2026-11-20 22:29:15	2026-11-20 22:29:15	VV23001	user
\.


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categories_id_seq', 7, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 8, true);


--
-- Name: post_images_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.post_images_id_seq', 85, true);


--
-- Name: post_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.post_user_id_seq', 32, true);


--
-- Name: posts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.posts_id_seq', 16, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 3, true);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: categories categories_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_name_unique UNIQUE (name);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: categories categories_slug_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_slug_unique UNIQUE (slug);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: post_images post_images_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_images
    ADD CONSTRAINT post_images_pkey PRIMARY KEY (id);


--
-- Name: post_user post_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_user
    ADD CONSTRAINT post_user_pkey PRIMARY KEY (id);


--
-- Name: post_user post_user_post_id_user_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_user
    ADD CONSTRAINT post_user_post_id_user_id_unique UNIQUE (post_id, user_id);


--
-- Name: posts posts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_pkey PRIMARY KEY (id);


--
-- Name: posts posts_slug_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_slug_unique UNIQUE (slug);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: users users_carnet_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_carnet_unique UNIQUE (carnet);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: cache_expiration_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX cache_expiration_index ON public.cache USING btree (expiration);


--
-- Name: cache_locks_expiration_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX cache_locks_expiration_index ON public.cache_locks USING btree (expiration);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: posts_published_at_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX posts_published_at_index ON public.posts USING btree (published_at);


--
-- Name: posts_status_activity_date_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX posts_status_activity_date_index ON public.posts USING btree (status, activity_date);


--
-- Name: posts_status_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX posts_status_index ON public.posts USING btree (status);


--
-- Name: posts_title_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX posts_title_index ON public.posts USING btree (title);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: post_images post_images_post_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_images
    ADD CONSTRAINT post_images_post_id_foreign FOREIGN KEY (post_id) REFERENCES public.posts(id) ON DELETE CASCADE;


--
-- Name: post_user post_user_post_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_user
    ADD CONSTRAINT post_user_post_id_foreign FOREIGN KEY (post_id) REFERENCES public.posts(id) ON DELETE CASCADE;


--
-- Name: post_user post_user_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_user
    ADD CONSTRAINT post_user_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: posts posts_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE RESTRICT;


--
-- Name: posts posts_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

\unrestrict jL8DOPJ77xjnpJsqVHfggfo21QDK6kivud5FPxecaz3CNb85l2jqKyNL98TicLA


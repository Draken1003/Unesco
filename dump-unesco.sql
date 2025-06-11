--
-- PostgreSQL database dump
--

-- Dumped from database version 14.17
-- Dumped by pg_dump version 17.0

-- Started on 2025-06-05 22:58:25 CEST

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

--
-- TOC entry 5 (class 2615 OID 18436)
-- Name: public; Type: SCHEMA; Schema: -; Owner: enzo
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO enzo;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 210 (class 1259 OID 18438)
-- Name: autorisation; Type: TABLE; Schema: public; Owner: enzo
--

CREATE TABLE public.autorisation (
    id_a integer NOT NULL,
    action character varying(200) NOT NULL,
    autorise boolean NOT NULL
);


ALTER TABLE public.autorisation OWNER TO enzo;

--
-- TOC entry 209 (class 1259 OID 18437)
-- Name: autorisation_id_a_seq; Type: SEQUENCE; Schema: public; Owner: enzo
--

CREATE SEQUENCE public.autorisation_id_a_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.autorisation_id_a_seq OWNER TO enzo;

--
-- TOC entry 3734 (class 0 OID 0)
-- Dependencies: 209
-- Name: autorisation_id_a_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: enzo
--

ALTER SEQUENCE public.autorisation_id_a_seq OWNED BY public.autorisation.id_a;


--
-- TOC entry 220 (class 1259 OID 18500)
-- Name: historique; Type: TABLE; Schema: public; Owner: enzo
--

CREATE TABLE public.historique (
    num_h integer NOT NULL,
    id_u integer NOT NULL,
    date_heure timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    raison character varying(255) NOT NULL
);


ALTER TABLE public.historique OWNER TO enzo;

--
-- TOC entry 219 (class 1259 OID 18499)
-- Name: historique_num_h_seq; Type: SEQUENCE; Schema: public; Owner: enzo
--

CREATE SEQUENCE public.historique_num_h_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.historique_num_h_seq OWNER TO enzo;

--
-- TOC entry 3735 (class 0 OID 0)
-- Dependencies: 219
-- Name: historique_num_h_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: enzo
--

ALTER SEQUENCE public.historique_num_h_seq OWNED BY public.historique.num_h;


--
-- TOC entry 216 (class 1259 OID 18471)
-- Name: monument; Type: TABLE; Schema: public; Owner: enzo
--

CREATE TABLE public.monument (
    id_m integer NOT NULL,
    nom character varying(50),
    description character varying(1500),
    google_map character varying(200),
    note numeric(10,2)
);


ALTER TABLE public.monument OWNER TO enzo;

--
-- TOC entry 215 (class 1259 OID 18470)
-- Name: monument_id_m_seq; Type: SEQUENCE; Schema: public; Owner: enzo
--

CREATE SEQUENCE public.monument_id_m_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.monument_id_m_seq OWNER TO enzo;

--
-- TOC entry 3736 (class 0 OID 0)
-- Dependencies: 215
-- Name: monument_id_m_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: enzo
--

ALTER SEQUENCE public.monument_id_m_seq OWNED BY public.monument.id_m;


--
-- TOC entry 212 (class 1259 OID 18445)
-- Name: role; Type: TABLE; Schema: public; Owner: enzo
--

CREATE TABLE public.role (
    id_r integer NOT NULL,
    _nom_r character varying(50) NOT NULL
);


ALTER TABLE public.role OWNER TO enzo;

--
-- TOC entry 211 (class 1259 OID 18444)
-- Name: role_id_r_seq; Type: SEQUENCE; Schema: public; Owner: enzo
--

CREATE SEQUENCE public.role_id_r_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.role_id_r_seq OWNER TO enzo;

--
-- TOC entry 3737 (class 0 OID 0)
-- Dependencies: 211
-- Name: role_id_r_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: enzo
--

ALTER SEQUENCE public.role_id_r_seq OWNED BY public.role.id_r;


--
-- TOC entry 218 (class 1259 OID 18485)
-- Name: section; Type: TABLE; Schema: public; Owner: enzo
--

CREATE TABLE public.section (
    id_s integer NOT NULL,
    langue_code character varying(3) NOT NULL,
    ordre integer NOT NULL,
    titre character varying(100) NOT NULL,
    texte character varying(1000) NOT NULL,
    id_m integer NOT NULL
);


ALTER TABLE public.section OWNER TO enzo;

--
-- TOC entry 217 (class 1259 OID 18484)
-- Name: section_id_s_seq; Type: SEQUENCE; Schema: public; Owner: enzo
--

CREATE SEQUENCE public.section_id_s_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.section_id_s_seq OWNER TO enzo;

--
-- TOC entry 3738 (class 0 OID 0)
-- Dependencies: 217
-- Name: section_id_s_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: enzo
--

ALTER SEQUENCE public.section_id_s_seq OWNED BY public.section.id_s;


--
-- TOC entry 214 (class 1259 OID 18457)
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: enzo
--

CREATE TABLE public.utilisateur (
    id_u integer NOT NULL,
    email character varying(100) NOT NULL,
    password character varying(100) NOT NULL,
    _nom character varying(50) NOT NULL,
    prenom character varying(50) NOT NULL,
    age integer NOT NULL,
    sexe character varying(50) NOT NULL,
    id_r integer
);


ALTER TABLE public.utilisateur OWNER TO enzo;

--
-- TOC entry 213 (class 1259 OID 18456)
-- Name: utilisateur_id_u_seq; Type: SEQUENCE; Schema: public; Owner: enzo
--

CREATE SEQUENCE public.utilisateur_id_u_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.utilisateur_id_u_seq OWNER TO enzo;

--
-- TOC entry 3739 (class 0 OID 0)
-- Dependencies: 213
-- Name: utilisateur_id_u_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: enzo
--

ALTER SEQUENCE public.utilisateur_id_u_seq OWNED BY public.utilisateur.id_u;


--
-- TOC entry 3553 (class 2604 OID 18441)
-- Name: autorisation id_a; Type: DEFAULT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.autorisation ALTER COLUMN id_a SET DEFAULT nextval('public.autorisation_id_a_seq'::regclass);


--
-- TOC entry 3558 (class 2604 OID 18503)
-- Name: historique num_h; Type: DEFAULT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.historique ALTER COLUMN num_h SET DEFAULT nextval('public.historique_num_h_seq'::regclass);


--
-- TOC entry 3556 (class 2604 OID 18474)
-- Name: monument id_m; Type: DEFAULT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.monument ALTER COLUMN id_m SET DEFAULT nextval('public.monument_id_m_seq'::regclass);


--
-- TOC entry 3554 (class 2604 OID 18448)
-- Name: role id_r; Type: DEFAULT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.role ALTER COLUMN id_r SET DEFAULT nextval('public.role_id_r_seq'::regclass);


--
-- TOC entry 3557 (class 2604 OID 18488)
-- Name: section id_s; Type: DEFAULT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.section ALTER COLUMN id_s SET DEFAULT nextval('public.section_id_s_seq'::regclass);


--
-- TOC entry 3555 (class 2604 OID 18460)
-- Name: utilisateur id_u; Type: DEFAULT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.utilisateur ALTER COLUMN id_u SET DEFAULT nextval('public.utilisateur_id_u_seq'::regclass);


--
-- TOC entry 3717 (class 0 OID 18438)
-- Dependencies: 210
-- Data for Name: autorisation; Type: TABLE DATA; Schema: public; Owner: enzo
--

COPY public.autorisation (id_a, action, autorise) FROM stdin;
\.


--
-- TOC entry 3727 (class 0 OID 18500)
-- Dependencies: 220
-- Data for Name: historique; Type: TABLE DATA; Schema: public; Owner: enzo
--

COPY public.historique (num_h, id_u, date_heure, raison) FROM stdin;
\.


--
-- TOC entry 3723 (class 0 OID 18471)
-- Dependencies: 216
-- Data for Name: monument; Type: TABLE DATA; Schema: public; Owner: enzo
--

COPY public.monument (id_m, nom, description, google_map, note) FROM stdin;
19	feeef	eefef	https://maps.app.goo.gl/MkcBSrybZcmBp5Ck6	\N
20	rff	fff	https://maps.app.goo.gl/MkcBSrybZcmBp5Ck6	\N
\.


--
-- TOC entry 3719 (class 0 OID 18445)
-- Dependencies: 212
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: enzo
--

COPY public.role (id_r, _nom_r) FROM stdin;
1	administrateur
2	gestionnaire
\.


--
-- TOC entry 3725 (class 0 OID 18485)
-- Dependencies: 218
-- Data for Name: section; Type: TABLE DATA; Schema: public; Owner: enzo
--

COPY public.section (id_s, langue_code, ordre, titre, texte, id_m) FROM stdin;
38	fr	1	zezezez	ezezezze	19
39	fr	2	ezezez	ezezez	19
40	fr	3	zeezze	ezezez	19
41	fr	1	effeef	feefefefef	20
42	fr	2	efefef	fefeefef	20
43	fr	3	efefefef	fefeef	20
\.


--
-- TOC entry 3721 (class 0 OID 18457)
-- Dependencies: 214
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: enzo
--

COPY public.utilisateur (id_u, email, password, _nom, prenom, age, sexe, id_r) FROM stdin;
0	f3aa73a66d1220d07882de3ae7ceebffa67e7b8de8d5a25e9c3c822bcaede7b7	578e9b738d5571e0602810bd803b2905482bf16c0baf545e62318b18f2ce167d	Cessy	David	50	homme	1
\.


--
-- TOC entry 3740 (class 0 OID 0)
-- Dependencies: 209
-- Name: autorisation_id_a_seq; Type: SEQUENCE SET; Schema: public; Owner: enzo
--

SELECT pg_catalog.setval('public.autorisation_id_a_seq', 1, false);


--
-- TOC entry 3741 (class 0 OID 0)
-- Dependencies: 219
-- Name: historique_num_h_seq; Type: SEQUENCE SET; Schema: public; Owner: enzo
--

SELECT pg_catalog.setval('public.historique_num_h_seq', 1, false);


--
-- TOC entry 3742 (class 0 OID 0)
-- Dependencies: 215
-- Name: monument_id_m_seq; Type: SEQUENCE SET; Schema: public; Owner: enzo
--

SELECT pg_catalog.setval('public.monument_id_m_seq', 20, true);


--
-- TOC entry 3743 (class 0 OID 0)
-- Dependencies: 211
-- Name: role_id_r_seq; Type: SEQUENCE SET; Schema: public; Owner: enzo
--

SELECT pg_catalog.setval('public.role_id_r_seq', 1, false);


--
-- TOC entry 3744 (class 0 OID 0)
-- Dependencies: 217
-- Name: section_id_s_seq; Type: SEQUENCE SET; Schema: public; Owner: enzo
--

SELECT pg_catalog.setval('public.section_id_s_seq', 43, true);


--
-- TOC entry 3745 (class 0 OID 0)
-- Dependencies: 213
-- Name: utilisateur_id_u_seq; Type: SEQUENCE SET; Schema: public; Owner: enzo
--

SELECT pg_catalog.setval('public.utilisateur_id_u_seq', 1, false);


--
-- TOC entry 3561 (class 2606 OID 18443)
-- Name: autorisation autorisation_pkey; Type: CONSTRAINT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.autorisation
    ADD CONSTRAINT autorisation_pkey PRIMARY KEY (id_a);


--
-- TOC entry 3573 (class 2606 OID 18506)
-- Name: historique historique_pkey; Type: CONSTRAINT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.historique
    ADD CONSTRAINT historique_pkey PRIMARY KEY (num_h);


--
-- TOC entry 3569 (class 2606 OID 18478)
-- Name: monument monument_pkey; Type: CONSTRAINT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.monument
    ADD CONSTRAINT monument_pkey PRIMARY KEY (id_m);


--
-- TOC entry 3563 (class 2606 OID 18450)
-- Name: role role_pkey; Type: CONSTRAINT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id_r);


--
-- TOC entry 3571 (class 2606 OID 18492)
-- Name: section section_pkey; Type: CONSTRAINT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.section
    ADD CONSTRAINT section_pkey PRIMARY KEY (id_s);


--
-- TOC entry 3565 (class 2606 OID 18464)
-- Name: utilisateur utilisateur_email_key; Type: CONSTRAINT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_email_key UNIQUE (email);


--
-- TOC entry 3567 (class 2606 OID 18462)
-- Name: utilisateur utilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pkey PRIMARY KEY (id_u);


--
-- TOC entry 3576 (class 2606 OID 18507)
-- Name: historique historique_id_u_fkey; Type: FK CONSTRAINT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.historique
    ADD CONSTRAINT historique_id_u_fkey FOREIGN KEY (id_u) REFERENCES public.utilisateur(id_u) ON DELETE CASCADE;


--
-- TOC entry 3575 (class 2606 OID 18493)
-- Name: section section_id_m_fkey; Type: FK CONSTRAINT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.section
    ADD CONSTRAINT section_id_m_fkey FOREIGN KEY (id_m) REFERENCES public.monument(id_m);


--
-- TOC entry 3574 (class 2606 OID 18465)
-- Name: utilisateur utilisateur_id_r_fkey; Type: FK CONSTRAINT; Schema: public; Owner: enzo
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_id_r_fkey FOREIGN KEY (id_r) REFERENCES public.role(id_r);


--
-- TOC entry 3733 (class 0 OID 0)
-- Dependencies: 5
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: enzo
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;


-- Completed on 2025-06-05 22:58:25 CEST

--
-- PostgreSQL database dump complete
--


-- Schema MySQL (mysql_novo) espelhado do PostgreSQL
-- Gerado em: 2026-07-23T18:00:09-03:00
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `camping_cam`;
CREATE TABLE `camping_cam` (
  `cd_camping_cam` int(11) NOT NULL AUTO_INCREMENT,
  `ds_nome_cam` varchar(255) DEFAULT NULL,
  `ds_sinopse_cam` text DEFAULT NULL,
  `ds_descricao_cam` text DEFAULT NULL,
  `cd_tipo_camping_tic` int(11) DEFAULT NULL,
  `cd_cidade_cde` int(11) DEFAULT NULL,
  `url_cam` varchar(255) DEFAULT NULL,
  `ds_imagem_cam` varchar(255) DEFAULT NULL,
  `total_visitas_cam` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ds_url_cam` varchar(255) DEFAULT NULL,
  `ds_capa_cam` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cd_camping_cam`),
  KEY `fk_camping_cam_cd_tipo_camping_tic` (`cd_tipo_camping_tic`),
  CONSTRAINT `fk_camping_cam_cd_tipo_camping_tic` FOREIGN KEY (`cd_tipo_camping_tic`) REFERENCES `tipo_camping_tic` (`cd_tipo_camping_tic`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `categoria_cat`;
CREATE TABLE `categoria_cat` (
  `id_categoria_cat` int(11) NOT NULL,
  `nm_categoria_cat` char(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `categoria_uc_cau`;
CREATE TABLE `categoria_uc_cau` (
  `id_categoria_uc_cau` int(11) NOT NULL AUTO_INCREMENT,
  `nm_categoria_uc_cau` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_categoria_uc_cau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cidade_cde`;
CREATE TABLE `cidade_cde` (
  `cd_cidade_cde` bigint(20) NOT NULL,
  `nm_cidade_cde` varchar(255) NOT NULL,
  `cd_estado_est` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `nu_mesorregiao_cde` smallint(6) DEFAULT NULL,
  `nm_mesorregiao_cde` varchar(255) DEFAULT NULL,
  `nm_microrregiao_cde` varchar(255) DEFAULT NULL,
  `nu_microrregiao_cde` smallint(6) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `descricao_cde` text DEFAULT NULL,
  PRIMARY KEY (`cd_cidade_cde`),
  KEY `fk_cidade_cde_cd_estado_est` (`cd_estado_est`),
  CONSTRAINT `fk_cidade_cde_cd_estado_est` FOREIGN KEY (`cd_estado_est`) REFERENCES `estado_est` (`cd_estado_est`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `comentario_com`;
CREATE TABLE `comentario_com` (
  `cd_comentario_com` int(11) NOT NULL AUTO_INCREMENT,
  `id_trilha_tri` int(11) DEFAULT NULL,
  `id_user_usu` int(11) DEFAULT NULL,
  `comentario_com` text DEFAULT NULL,
  `total_likes_com` int(11) DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_comentario_com`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `complemento_nivel_con`;
CREATE TABLE `complemento_nivel_con` (
  `id_complemento_nivel_con` int(11) NOT NULL AUTO_INCREMENT,
  `nm_complemento_nivel_con` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nu_pontos_con` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_complemento_nivel_con`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `corrida_cor`;
CREATE TABLE `corrida_cor` (
  `cd_corrida_cor` int(11) NOT NULL AUTO_INCREMENT,
  `ds_corrida_cor` varchar(255) DEFAULT NULL,
  `nu_score_cor` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_corrida_cor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `distancia_dis`;
CREATE TABLE `distancia_dis` (
  `cd_distancia_dis` int(11) NOT NULL,
  `ds_distancia_dis` varchar(255) DEFAULT NULL,
  `nu_score_dis` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_distancia_dis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `elevacao_ele`;
CREATE TABLE `elevacao_ele` (
  `cd_elevacao_ele` int(11) NOT NULL AUTO_INCREMENT,
  `ds_elevacao_ele` varchar(255) DEFAULT NULL,
  `nu_score_ele` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_elevacao_ele`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `estado_est`;
CREATE TABLE `estado_est` (
  `cd_estado_est` bigint(20) NOT NULL,
  `nm_estado_est` varchar(255) NOT NULL,
  `cd_pais_pai` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `sg_estado_est` char(2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_estado_est`),
  KEY `fk_estado_est_cd_pais_pai` (`cd_pais_pai`),
  CONSTRAINT `fk_estado_est_cd_pais_pai` FOREIGN KEY (`cd_pais_pai`) REFERENCES `pais_pai` (`cd_pais_pai`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `estatistica_acesso_esa`;
CREATE TABLE `estatistica_acesso_esa` (
  `cd_estatistica_acesso_esa` bigint(20) NOT NULL AUTO_INCREMENT,
  `cd_monitoramento_esa` int(11) DEFAULT NULL,
  `cd_usuario_usu` int(11) DEFAULT NULL,
  `cd_tipo_monitoramento_tim` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_estatistica_acesso_esa`),
  KEY `fk_estatistica_acesso_esa_cd_tipo_monitoramento_tim` (`cd_tipo_monitoramento_tim`),
  CONSTRAINT `fk_estatistica_acesso_esa_cd_tipo_monitoramento_tim` FOREIGN KEY (`cd_tipo_monitoramento_tim`) REFERENCES `tipo_monitoramento_tim` (`cd_tipo_monitoramento_tim`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `evento_eve`;
CREATE TABLE `evento_eve` (
  `id_evento_eve` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_guia_gui` int(11) DEFAULT NULL,
  `cd_cidade_cde` bigint(20) DEFAULT NULL,
  `nm_evento_eve` varchar(255) DEFAULT NULL,
  `ds_fone_contato_eve` varchar(255) DEFAULT NULL,
  `dt_realizacao_eve` timestamp NULL DEFAULT NULL,
  `dt_termino_eve` timestamp NULL DEFAULT NULL,
  `valor_eve` decimal(12,2) DEFAULT NULL,
  `total_participantes_eve` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ds_imagem_vertical_eve` varchar(255) DEFAULT NULL,
  `ds_imagem_horizontal_eve` varchar(255) DEFAULT NULL,
  `fl_ativo_eve` tinyint(1) DEFAULT 0,
  `hora_inicio_eve` time DEFAULT NULL,
  `hora_fim_eve` time DEFAULT NULL,
  `slug_eve` varchar(255) DEFAULT NULL,
  `fl_privado_eve` tinyint(1) DEFAULT 0,
  `id_unico_eve` int(11) DEFAULT NULL,
  `id_trilha_tri` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_evento_eve`),
  KEY `fk_evento_eve_cd_cidade_cde` (`cd_cidade_cde`),
  KEY `fk_evento_eve_id_guia_gui` (`id_guia_gui`),
  CONSTRAINT `fk_evento_eve_cd_cidade_cde` FOREIGN KEY (`cd_cidade_cde`) REFERENCES `cidade_cde` (`cd_cidade_cde`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_evento_eve_id_guia_gui` FOREIGN KEY (`id_guia_gui`) REFERENCES `guia_gui` (`id_guia_gui`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `evento_trilheiro_evt`;
CREATE TABLE `evento_trilheiro_evt` (
  `cd_evento_trilheiro_evt` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento_eve` bigint(20) DEFAULT NULL,
  `id_trilheiro_tri` int(11) DEFAULT NULL,
  `fl_aceito_guia_evt` tinyint(1) DEFAULT NULL,
  `fl_pago_evt` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_evento_trilheiro_evt`),
  KEY `fk_evento_trilheiro_evt_id_evento_eve` (`id_evento_eve`),
  KEY `fk_evento_trilheiro_evt_id_trilheiro_tri` (`id_trilheiro_tri`),
  CONSTRAINT `fk_evento_trilheiro_evt_id_evento_eve` FOREIGN KEY (`id_evento_eve`) REFERENCES `evento_eve` (`id_evento_eve`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evento_trilheiro_evt_id_trilheiro_tri` FOREIGN KEY (`id_trilheiro_tri`) REFERENCES `trilheiro_tri` (`id_trilheiro_tri`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` text NOT NULL,
  `exception` text NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `fone_fon`;
CREATE TABLE `fone_fon` (
  `id_guia_gui` int(11) NOT NULL,
  `id_tipo_fone_tif` smallint(6) DEFAULT NULL,
  `nu_fone_fon` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_fone_fon` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_fone_fon`),
  KEY `fk_fone_fon_id_guia_gui` (`id_guia_gui`),
  KEY `fk_fone_fon_id_tipo_fone_tif` (`id_tipo_fone_tif`),
  CONSTRAINT `fk_fone_fon_id_guia_gui` FOREIGN KEY (`id_guia_gui`) REFERENCES `guia_gui` (`id_guia_gui`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fone_fon_id_tipo_fone_tif` FOREIGN KEY (`id_tipo_fone_tif`) REFERENCES `tipo_fone_tif` (`id_tipo_fone_tif`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `foto_fot`;
CREATE TABLE `foto_fot` (
  `id_foto_fot` bigint(20) NOT NULL AUTO_INCREMENT,
  `nm_foto_fot` varchar(255) NOT NULL,
  `nm_path_fot` varchar(255) NOT NULL,
  `dc_alt_fot` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_trilha_tri` int(11) DEFAULT NULL,
  `id_tipo_foto_tfo` int(11) NOT NULL,
  `id_galeria_gal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_foto_fot`),
  KEY `fk_foto_fot_id_tipo_foto_tfo` (`id_tipo_foto_tfo`),
  KEY `fk_foto_fot_id_trilha_tri` (`id_trilha_tri`),
  CONSTRAINT `fk_foto_fot_id_tipo_foto_tfo` FOREIGN KEY (`id_tipo_foto_tfo`) REFERENCES `tipo_foto_tfo` (`id_tipo_foto_tfo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_foto_fot_id_trilha_tri` FOREIGN KEY (`id_trilha_tri`) REFERENCES `trilha_tri` (`id_trilha_tri`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `galeria_fotos_gaf`;
CREATE TABLE `galeria_fotos_gaf` (
  `id_galeria_fotos_gaf` int(11) NOT NULL AUTO_INCREMENT,
  `id_galeria_gal` int(11) DEFAULT NULL,
  `id_foto_fot` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_galeria_fotos_gaf`),
  KEY `fki_foto_fot_fk` (`id_foto_fot`),
  CONSTRAINT `fk_galeria_fotos_gaf_id_foto_fot` FOREIGN KEY (`id_foto_fot`) REFERENCES `foto_fot` (`id_foto_fot`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_galeria_fotos_gaf_id_galeria_fotos_gaf` FOREIGN KEY (`id_galeria_fotos_gaf`) REFERENCES `galeria_gal` (`id_galeria_gal`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `galeria_gal`;
CREATE TABLE `galeria_gal` (
  `id_galeria_gal` int(11) NOT NULL AUTO_INCREMENT,
  `nm_galeria_gal` char(255) DEFAULT NULL,
  `fl_ativa_gal` char(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ds_galeria_gal` text DEFAULT NULL,
  `url_gal` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_galeria_gal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `guia_cidade_atuacao_gca`;
CREATE TABLE `guia_cidade_atuacao_gca` (
  `id_guia_cidade_atuacao_gca` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_guia_gui` int(11) NOT NULL,
  `cd_cidade_cde` bigint(20) NOT NULL,
  PRIMARY KEY (`id_guia_cidade_atuacao_gca`),
  KEY `fk_guia_cidade_atuacao_gca_cd_cidade_cde` (`cd_cidade_cde`),
  KEY `fk_guia_cidade_atuacao_gca_id_guia_gui` (`id_guia_gui`),
  CONSTRAINT `fk_guia_cidade_atuacao_gca_cd_cidade_cde` FOREIGN KEY (`cd_cidade_cde`) REFERENCES `cidade_cde` (`cd_cidade_cde`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_guia_cidade_atuacao_gca_id_guia_gui` FOREIGN KEY (`id_guia_gui`) REFERENCES `guia_gui` (`id_guia_gui`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `guia_gui`;
CREATE TABLE `guia_gui` (
  `id_guia_gui` int(11) NOT NULL AUTO_INCREMENT,
  `nm_guia_gui` varchar(255) DEFAULT NULL,
  `nm_instagram_gui` varchar(255) DEFAULT NULL,
  `nm_site_gui` varchar(255) DEFAULT NULL,
  `nm_path_logo_gui` varchar(255) DEFAULT NULL,
  `dc_biografia_gui` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `cd_cidade_origem_gui` bigint(20) DEFAULT NULL,
  `ds_atuacao_gui` text DEFAULT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `fl_perfil_completo_gui` tinyint(1) DEFAULT 0,
  `fl_perfil_moderado_gui` tinyint(1) DEFAULT 0,
  `fl_perfil_recusado_gui` tinyint(1) DEFAULT 0,
  `fl_ativo_gui` tinyint(1) DEFAULT 0,
  `nu_cadastur_gui` varchar(255) DEFAULT NULL,
  `obs_gui` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_guia_gui`),
  KEY `fk_guia_gui_cd_cidade_origem_gui` (`cd_cidade_origem_gui`),
  KEY `fk_guia_gui_id_user` (`id_user`),
  CONSTRAINT `fk_guia_gui_cd_cidade_origem_gui` FOREIGN KEY (`cd_cidade_origem_gui`) REFERENCES `cidade_cde` (`cd_cidade_cde`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_guia_gui_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `guia_interacao_gin`;
CREATE TABLE `guia_interacao_gin` (
  `id_guia_interacao_gin` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_tipo_interacao_tin` smallint(6) NOT NULL,
  `id_guia_gui` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_guia_interacao_gin`),
  KEY `fk_guia_interacao_gin_id_guia_gui` (`id_guia_gui`),
  KEY `fk_guia_interacao_gin_id_tipo_interacao_tin` (`id_tipo_interacao_tin`),
  CONSTRAINT `fk_guia_interacao_gin_id_guia_gui` FOREIGN KEY (`id_guia_gui`) REFERENCES `guia_gui` (`id_guia_gui`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_guia_interacao_gin_id_tipo_interacao_tin` FOREIGN KEY (`id_tipo_interacao_tin`) REFERENCES `tipo_interacao_tin` (`id_tipo_interacao_tin`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `guia_trilha_gut`;
CREATE TABLE `guia_trilha_gut` (
  `id_guia_gui` int(11) DEFAULT NULL,
  `id_trilha_tri` int(11) DEFAULT NULL,
  `id_guia_trilha_gut` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_guia_trilha_gut`),
  UNIQUE KEY `guia_trilha_gut_unique` (`id_guia_gui`,`id_trilha_tri`),
  KEY `fk_guia_trilha_gut_id_trilha_tri` (`id_trilha_tri`),
  CONSTRAINT `fk_guia_trilha_gut_id_guia_gui` FOREIGN KEY (`id_guia_gui`) REFERENCES `guia_gui` (`id_guia_gui`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_guia_trilha_gut_id_trilha_tri` FOREIGN KEY (`id_trilha_tri`) REFERENCES `trilha_tri` (`id_trilha_tri`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `guia_unidade_conservacao_guc`;
CREATE TABLE `guia_unidade_conservacao_guc` (
  `id_guia_unidade_conservacao_guc` int(11) NOT NULL AUTO_INCREMENT,
  `id_unidade_conservacao_unc` int(11) DEFAULT NULL,
  `id_guia_gui` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_guia_unidade_conservacao_guc`),
  KEY `fk_guia_unidade_conservacao_guc_id_guia_gui` (`id_guia_gui`),
  KEY `fk_guia_unidade_conservacao_guc_id_unidade_conservacao_unc` (`id_unidade_conservacao_unc`),
  CONSTRAINT `fk_guia_unidade_conservacao_guc_id_guia_gui` FOREIGN KEY (`id_guia_gui`) REFERENCES `guia_gui` (`id_guia_gui`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_guia_unidade_conservacao_guc_id_unidade_conservacao_unc` FOREIGN KEY (`id_unidade_conservacao_unc`) REFERENCES `unidade_conservacao_unc` (`id_unidade_conservacao_unc`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `hospedagem_hos`;
CREATE TABLE `hospedagem_hos` (
  `cd_hospedagem_hos` int(11) NOT NULL AUTO_INCREMENT,
  `cd_expedicao_exp` bigint(20) DEFAULT NULL,
  `nm_hospedagem_hos` varchar(255) DEFAULT NULL,
  `nu_dias_hos` int(11) DEFAULT NULL,
  `dt_chegada_hos` timestamp NULL DEFAULT NULL,
  `dt_saida_hos` timestamp NULL DEFAULT NULL,
  `valor_total_hos` float DEFAULT NULL,
  `total_hospedes_hos` int(11) DEFAULT NULL,
  `valor_individual_hos` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ds_url_hos` varchar(255) DEFAULT NULL,
  `ds_cidade_hos` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cd_hospedagem_hos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `hospedagem_quarto_hoq`;
CREATE TABLE `hospedagem_quarto_hoq` (
  `cd_hospedagem_quarto_hoq` int(11) NOT NULL AUTO_INCREMENT,
  `cd_hospedagem_hos` bigint(20) DEFAULT NULL,
  `ds_quarto_hoq` varchar(255) DEFAULT NULL,
  `nu_pessoas_hoq` int(11) DEFAULT NULL,
  `fl_banheiro_hoq` tinyint(1) DEFAULT NULL,
  `fl_cafe_hoq` tinyint(1) DEFAULT NULL,
  `obs_hoq` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_hospedagem_quarto_hoq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `indice_ind`;
CREATE TABLE `indice_ind` (
  `id_indice_ind` int(11) NOT NULL AUTO_INCREMENT,
  `ds_indice_ind` varchar(255) DEFAULT NULL,
  `img_indice_ind` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `descricao_ind` varchar(255) DEFAULT NULL,
  `ds_sigla_ind` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_indice_ind`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `instagram_media_metrics`;
CREATE TABLE `instagram_media_metrics` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `instagram_account_id` varchar(100) NOT NULL,
  `media_id` varchar(100) NOT NULL,
  `media_type` varchar(50) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `permalink` text DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `published_hour` smallint(6) DEFAULT NULL,
  `published_weekday` smallint(6) DEFAULT NULL,
  `reach` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `comments` int(11) DEFAULT NULL,
  `shares` int(11) DEFAULT NULL,
  `saves` int(11) DEFAULT NULL,
  `total_interactions` int(11) DEFAULT NULL,
  `raw_payload` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `instagram_media_unique` (`instagram_account_id`,`media_id`),
  KEY `instagram_media_published_at_idx` (`published_at`),
  KEY `instagram_media_published_hour_idx` (`published_hour`),
  KEY `instagram_media_weekday_idx` (`published_weekday`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `instagram_metric_snapshots`;
CREATE TABLE `instagram_metric_snapshots` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `instagram_account_id` varchar(100) NOT NULL,
  `metric_date` date NOT NULL,
  `followers_count` int(11) DEFAULT NULL,
  `reach` int(11) DEFAULT NULL,
  `impressions` int(11) DEFAULT NULL,
  `profile_views` int(11) DEFAULT NULL,
  `website_clicks` int(11) DEFAULT NULL,
  `raw_payload` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `attempts` smallint(6) NOT NULL,
  `reserved_at` int(11) DEFAULT NULL,
  `available_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`),
  KEY `jobs_queue_reserved_available_idx` (`queue`,`reserved_at`,`available_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `log_email_loe`;
CREATE TABLE `log_email_loe` (
  `cd_log_email_loe` int(11) NOT NULL AUTO_INCREMENT,
  `id_trilha_tri` int(11) DEFAULT NULL,
  `cd_tipo_envio_tie` int(11) DEFAULT NULL,
  `nu_total_envios_loe` int(11) DEFAULT NULL,
  `dt_envio_loe` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_log_email_loe`),
  KEY `fk_log_email_loe_id_trilha_tri` (`id_trilha_tri`),
  CONSTRAINT `fk_log_email_loe_id_trilha_tri` FOREIGN KEY (`id_trilha_tri`) REFERENCES `trilha_tri` (`id_trilha_tri`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `nivel_niv`;
CREATE TABLE `nivel_niv` (
  `id_nivel_niv` smallint(6) NOT NULL AUTO_INCREMENT,
  `dc_nivel_niv` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `dc_icone_niv` varchar(255) DEFAULT NULL,
  `dc_color_nivel_niv` varchar(255) DEFAULT NULL,
  `ordem_niv` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nivel_niv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `pais_pai`;
CREATE TABLE `pais_pai` (
  `cd_pais_pai` int(11) NOT NULL AUTO_INCREMENT,
  `nm_pais_pai` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `sg_pais_pai` char(2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_pais_pai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `praia_pra`;
CREATE TABLE `praia_pra` (
  `cd_praia_pra` int(11) NOT NULL,
  `cd_regiao_reg` int(11) DEFAULT NULL,
  `nm_praia_pra` varchar(255) DEFAULT NULL,
  `ds_url_pra` varchar(255) DEFAULT NULL,
  `txt_descricao_pra` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `publicidade_estatistica_pue`;
CREATE TABLE `publicidade_estatistica_pue` (
  `id_publicidade_estatistica_pue` int(11) NOT NULL,
  `id_publicidade_pub` int(11) DEFAULT NULL,
  `nu_ip_pue` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ds_cidade_pue` varchar(255) DEFAULT NULL,
  `ds_uf_pue` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `publicidade_pub`;
CREATE TABLE `publicidade_pub` (
  `id_publicidade_pub` int(11) NOT NULL AUTO_INCREMENT,
  `ds_publicidade_pub` varchar(255) DEFAULT NULL,
  `ds_codigo_pub` varchar(255) DEFAULT NULL,
  `nu_acessos_pub` int(11) DEFAULT NULL,
  `dt_inicio_pub` timestamp NULL DEFAULT NULL,
  `dt_fim_pub` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ds_link_pub` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_publicidade_pub`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `qrcode_qrc`;
CREATE TABLE `qrcode_qrc` (
  `cd_qrcode_qrc` int(11) NOT NULL AUTO_INCREMENT,
  `cd_usuario_usu` int(11) DEFAULT NULL,
  `ds_link_qrc` varchar(255) DEFAULT NULL,
  `nu_acessos_qrc` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ds_hash_qrc` varchar(255) DEFAULT NULL,
  `ds_nome_qrc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cd_qrcode_qrc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `questionario_score_que`;
CREATE TABLE `questionario_score_que` (
  `cd_questionario_score_que` bigint(20) NOT NULL AUTO_INCREMENT,
  `cd_trilheiro_tri` bigint(20) DEFAULT NULL,
  `cd_distancia_dis` int(11) DEFAULT NULL,
  `cd_elevacao_ele` int(11) DEFAULT NULL,
  `fl_corrida_que` tinyint(1) DEFAULT NULL,
  `nu_distancia_que` int(11) DEFAULT NULL,
  `fl_musculacao_que` tinyint(1) DEFAULT NULL,
  `fl_trilhas_que` tinyint(1) DEFAULT NULL,
  `fl_travessia_que` tinyint(1) DEFAULT NULL,
  `fl_altura_que` tinyint(1) DEFAULT NULL,
  `fl_trekking_que` tinyint(1) DEFAULT NULL,
  `nu_altura_que` float DEFAULT NULL,
  `nu_peso_que` float DEFAULT NULL,
  `fl_areia_que` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `cd_corrida_cor` bigint(20) DEFAULT NULL,
  `fl_hiking_que` tinyint(1) DEFAULT NULL,
  `nu_costao_que` int(11) DEFAULT NULL,
  `fl_ferrata_que` tinyint(1) DEFAULT NULL,
  `fl_acampamento_que` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`cd_questionario_score_que`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `regiao_reg`;
CREATE TABLE `regiao_reg` (
  `cd_regiao_reg` int(11) NOT NULL,
  `nm_regiao_reg` varchar(255) DEFAULT NULL,
  `ds_apelido_regiao_reg` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tag_tag`;
CREATE TABLE `tag_tag` (
  `cd_tag_tag` int(11) NOT NULL AUTO_INCREMENT,
  `ds_tag_tag` varchar(255) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_tag_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tipo_camping_tic`;
CREATE TABLE `tipo_camping_tic` (
  `cd_tipo_camping_tic` int(11) NOT NULL AUTO_INCREMENT,
  `ds_tipo_tic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ds_img_tic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cd_tipo_camping_tic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tipo_fone_tif`;
CREATE TABLE `tipo_fone_tif` (
  `id_tipo_fone_tif` smallint(6) NOT NULL,
  `nm_tipo_tif` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo_fone_tif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tipo_foto_tfo`;
CREATE TABLE `tipo_foto_tfo` (
  `id_tipo_foto_tfo` int(11) NOT NULL AUTO_INCREMENT,
  `nm_tipo_foto_tfo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `dc_path_tfp` varchar(255) NOT NULL,
  `height_tfo` bigint(20) DEFAULT NULL,
  `width_tfo` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_foto_tfo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tipo_interacao_tin`;
CREATE TABLE `tipo_interacao_tin` (
  `id_tipo_interacao_tin` smallint(6) NOT NULL,
  `nm_tipo_tin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_interacao_tin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tipo_monitoramento_tim`;
CREATE TABLE `tipo_monitoramento_tim` (
  `cd_tipo_monitoramento_tim` int(11) NOT NULL AUTO_INCREMENT,
  `ds_tipo_monitoramento_tim` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_tipo_monitoramento_tim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tipo_trilha_tit`;
CREATE TABLE `tipo_trilha_tit` (
  `id_tipo_trilha_tit` int(11) NOT NULL AUTO_INCREMENT,
  `ds_tipo_trilha_tit` varchar(255) DEFAULT NULL,
  `descricao_tipo_tit` text DEFAULT NULL,
  `icone_tipo_tit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_trilha_tit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `total_acessos_trilhas_tat`;
CREATE TABLE `total_acessos_trilhas_tat` (
  `cd_total_acessos_trilhas_tat` int(11) NOT NULL AUTO_INCREMENT,
  `id_trilha_tri` int(11) DEFAULT NULL,
  `nm_trilha_tri` varchar(255) DEFAULT NULL,
  `total_acessos_tat` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_total_acessos_trilhas_tat`),
  KEY `fk_total_acessos_trilhas_tat_id_trilha_tri` (`id_trilha_tri`),
  CONSTRAINT `fk_total_acessos_trilhas_tat_id_trilha_tri` FOREIGN KEY (`id_trilha_tri`) REFERENCES `trilha_tri` (`id_trilha_tri`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `trilha_detalhes_trd`;
CREATE TABLE `trilha_detalhes_trd` (
  `cd_trilha_detalhes_trd` int(11) NOT NULL AUTO_INCREMENT,
  `id_trilha_tri` int(11) DEFAULT NULL,
  `nu_distancia_trd` float DEFAULT NULL,
  `duracao_trd` time DEFAULT NULL,
  `ds_exposicao_trd` varchar(255) DEFAULT NULL,
  `ds_esforco_trd` varchar(255) DEFAULT NULL,
  `ds_orientacao_trd` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_trilha_detalhes_trd`),
  KEY `fk_trilha_detalhes_trd_id_trilha_tri` (`id_trilha_tri`),
  CONSTRAINT `fk_trilha_detalhes_trd_id_trilha_tri` FOREIGN KEY (`id_trilha_tri`) REFERENCES `trilha_tri` (`id_trilha_tri`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `trilha_tag_trt`;
CREATE TABLE `trilha_tag_trt` (
  `cd_trilha_tag_trt` int(11) NOT NULL AUTO_INCREMENT,
  `id_trilha_tri` int(11) DEFAULT NULL,
  `cd_tag_tag` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`cd_trilha_tag_trt`),
  KEY `fki_cd_tag_tag_fk` (`cd_tag_tag`),
  KEY `fki_trilha_tri_fk` (`id_trilha_tri`),
  CONSTRAINT `fk_trilha_tag_trt_cd_tag_tag` FOREIGN KEY (`cd_tag_tag`) REFERENCES `tag_tag` (`cd_tag_tag`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_trilha_tag_trt_id_trilha_tri` FOREIGN KEY (`id_trilha_tri`) REFERENCES `trilha_tri` (`id_trilha_tri`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `trilha_tri`;
CREATE TABLE `trilha_tri` (
  `id_trilha_tri` int(11) NOT NULL AUTO_INCREMENT,
  `nm_trilha_tri` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ds_url_tri` varchar(255) DEFAULT NULL,
  `cd_cidade_cde` bigint(20) NOT NULL,
  `id_categoria_cat` int(11) NOT NULL,
  `ds_trilha_tri` text DEFAULT NULL,
  `id_nivel_niv` smallint(6) NOT NULL,
  `total_votos_tri` int(11) DEFAULT 0,
  `id_user_usu` bigint(20) DEFAULT NULL,
  `id_complemento_nivel_con` int(11) DEFAULT NULL,
  `url_geolocalizacao_tri` text DEFAULT NULL,
  `fl_publicacao_tri` char(1) DEFAULT 'N',
  `fl_avaliacao_tri` char(1) DEFAULT 'N',
  `fl_destaque_tri` tinyint(1) DEFAULT 0,
  `id_tipo_trilha_tit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_trilha_tri`),
  KEY `fki_users_fk` (`id_user_usu`),
  KEY `fk_trilha_tri_id_complemento_nivel_con` (`id_complemento_nivel_con`),
  KEY `fk_trilha_tri_id_nivel_niv` (`id_nivel_niv`),
  KEY `fk_trilha_tri_id_tipo_trilha_tit` (`id_tipo_trilha_tit`),
  KEY `fk_trilha_tri_cd_cidade_cde` (`cd_cidade_cde`),
  CONSTRAINT `fk_trilha_tri_cd_cidade_cde` FOREIGN KEY (`cd_cidade_cde`) REFERENCES `cidade_cde` (`cd_cidade_cde`),
  CONSTRAINT `fk_trilha_tri_id_complemento_nivel_con` FOREIGN KEY (`id_complemento_nivel_con`) REFERENCES `complemento_nivel_con` (`id_complemento_nivel_con`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trilha_tri_id_nivel_niv` FOREIGN KEY (`id_nivel_niv`) REFERENCES `nivel_niv` (`id_nivel_niv`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trilha_tri_id_tipo_trilha_tit` FOREIGN KEY (`id_tipo_trilha_tit`) REFERENCES `tipo_trilha_tit` (`id_tipo_trilha_tit`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_trilha_tri_id_user_usu` FOREIGN KEY (`id_user_usu`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `trilheiro_tri`;
CREATE TABLE `trilheiro_tri` (
  `id_trilheiro_tri` int(11) NOT NULL AUTO_INCREMENT,
  `nm_trilheiro_tri` varchar(255) DEFAULT NULL,
  `nm_path_foto_tri` varchar(255) DEFAULT NULL,
  `dc_biografia_tri` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `cd_cidade_tri` bigint(20) DEFAULT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `fl_perfil_tri` tinyint(1) DEFAULT 0,
  `id_indice_ind` int(11) DEFAULT 1,
  `nr_score_tri` int(11) DEFAULT 0,
  `cd_estado_est` int(11) DEFAULT NULL,
  `cd_sexo_sex` char(1) DEFAULT NULL,
  `dt_nascimento` date DEFAULT NULL,
  `ds_objetivos_tri` text DEFAULT NULL,
  `nu_pontos_experiencia_tri` int(11) DEFAULT 0,
  `fl_newsletter_tri` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id_trilheiro_tri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `trilheiro_trilha_ttr`;
CREATE TABLE `trilheiro_trilha_ttr` (
  `id_trilheiro_trilha_ttr` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_trilha_tri` int(11) NOT NULL,
  `id_trilheiro_tri` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_trilheiro_trilha_ttr`),
  UNIQUE KEY `trilheiro_trilha_ttr_unique` (`id_trilheiro_tri`,`id_trilha_tri`),
  KEY `fk_trilheiro_trilha_ttr_id_trilha_tri` (`id_trilha_tri`),
  CONSTRAINT `fk_trilheiro_trilha_ttr_id_trilha_tri` FOREIGN KEY (`id_trilha_tri`) REFERENCES `trilha_tri` (`id_trilha_tri`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trilheiro_trilha_ttr_id_trilheiro_tri` FOREIGN KEY (`id_trilheiro_tri`) REFERENCES `trilheiro_tri` (`id_trilheiro_tri`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `unidade_conservacao_cidade_ucc`;
CREATE TABLE `unidade_conservacao_cidade_ucc` (
  `id_unidade_conservacao_cidade_ucc` int(11) NOT NULL AUTO_INCREMENT,
  `id_unidade_conservacao_unc` int(11) DEFAULT NULL,
  `cd_cidade_cde` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_unidade_conservacao_cidade_ucc`),
  KEY `fk_unidade_conservacao_cidade_ucc_cd_cidade_cde` (`cd_cidade_cde`),
  KEY `fk_unidade_conservacao_cidade_ucc_id_unidade_conservacao_unc` (`id_unidade_conservacao_unc`),
  CONSTRAINT `fk_unidade_conservacao_cidade_ucc_cd_cidade_cde` FOREIGN KEY (`cd_cidade_cde`) REFERENCES `cidade_cde` (`cd_cidade_cde`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_unidade_conservacao_cidade_ucc_id_unidade_conservacao_unc` FOREIGN KEY (`id_unidade_conservacao_unc`) REFERENCES `unidade_conservacao_unc` (`id_unidade_conservacao_unc`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `unidade_conservacao_instancia_uci`;
CREATE TABLE `unidade_conservacao_instancia_uci` (
  `id_unidade_conservacao_instancia_uci` int(11) NOT NULL AUTO_INCREMENT,
  `nm_unidade_conservacao_instancia_uci` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_unidade_conservacao_instancia_uci`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `unidade_conservacao_unc`;
CREATE TABLE `unidade_conservacao_unc` (
  `id_unidade_conservacao_unc` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria_uc_cau` int(11) DEFAULT NULL,
  `nome_unc` varchar(255) DEFAULT NULL,
  `sigla_unc` varchar(255) DEFAULT NULL,
  `site_unc` varchar(255) DEFAULT NULL,
  `descricao_unc` text DEFAULT NULL,
  `logo_unc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `id_unidade_conservacao_instancia_uci` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_unidade_conservacao_unc`),
  KEY `fk_unidade_conservacao_unc_id_unidade_conservacao_instancia_uci` (`id_unidade_conservacao_instancia_uci`),
  KEY `fk_unidade_conservacao_unc_id_categoria_uc_cau` (`id_categoria_uc_cau`),
  CONSTRAINT `fk_unidade_conservacao_unc_id_categoria_uc_cau` FOREIGN KEY (`id_categoria_uc_cau`) REFERENCES `categoria_uc_cau` (`id_categoria_uc_cau`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_unidade_conservacao_unc_id_unidade_conservacao_instancia_uci` FOREIGN KEY (`id_unidade_conservacao_instancia_uci`) REFERENCES `unidade_conservacao_instancia_uci` (`id_unidade_conservacao_instancia_uci`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_role` varchar(50) DEFAULT 'GUEST',
  `fl_facebook` char(1) DEFAULT 'N',
  `fl_google` char(1) DEFAULT 'N',
  `dc_foto_perfil` varchar(50) DEFAULT NULL,
  `dt_last_login` timestamp NULL DEFAULT NULL,
  `fl_social_usu` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users_log`;
CREATE TABLE `users_log` (
  `id_users_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_usu` int(11) DEFAULT NULL,
  `ds_cidade_log` varchar(255) DEFAULT NULL,
  `ds_uf_log` varchar(255) DEFAULT NULL,
  `nu_ip_log` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_users_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;

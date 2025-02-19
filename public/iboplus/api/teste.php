import requests

# Detalhes do usuário
usuario = "seu_usuario"
senha = "sua_senha"
dns = "seu_dns"

# Mapeamento MAC para caminho de imagem
mac_para_imagem = {
    "00:11:22:33:44:55": "caminho/para/imagem1.jpg",
    "66:77:88:99:AA:BB": "caminho/para/imagem2.jpg",
    # Adicione mais mapeamentos conforme necessário
}

# URL do APK (modifique conforme necessário)
url = "http://url_do_seu_apk"

# Função para enviar dados e imagem para um MAC específico
def enviar_informacoes(mac):
    caminho_imagem = mac_para_imagem.get(mac)

    if caminho_imagem:
        # Prepare os dados e o arquivo de imagem
        dados = {
            'usuario': usuario,
            'senha': senha,
            'dns': dns,
            'mac': mac
        }
        arquivos = {
            'imagem': open(caminho_imagem, 'rb')
        }

        # Enviar solicitação POST
        resposta = requests.post(url, data=dados, files=arquivos)

        # Verificar a resposta
        if resposta.status_code == 200:
            print(f"Informações e imagem para MAC {mac} enviadas com sucesso!")
        else:
            print(f"Falha ao enviar para MAC {mac}. Código de status: {resposta.status_code}")
    else:
        print(f"Nenhuma imagem encontrada para MAC {mac}")

# Lista de MACs para os quais você deseja enviar informações
macs = ["00:11:22:33:44:55", "66:77:88:99:AA:BB"]

for mac in macs:
    enviar_informacoes(mac)

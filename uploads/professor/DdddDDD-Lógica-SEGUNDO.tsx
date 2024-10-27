import '../app/styles/globals.css'
import { Inter } from 'next/font/google'
import Header from '../app/components/header'

const inter = Inter({ subsets: ['latin'] })

export const metadata = {
  title: "Professor Evandro - Programação",
  description: "Professor Evandro é um educador experiente em programação, especializado em ensinar desenvolvimento de software.",
  applicationName: "Professor Evandro - Programação",
  viewport: "width=device-width, initial-scale=1.0",
  robots: "index, follow",
  openGraph: {
    title: "Professor Evandro - Programação",
    description: "Explorando as habilidades, experiência e projetos de ensino de programação do Professor Evandro.",
    url: "https://professorevando.com",
    type: "website",
    locale: "pt_BR",
  },
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="pt_BR">
      <body className={`${inter.className} min-h-screen bg-[#18122B] text-[#6E62A4]`}>
        <Header />
        <main className="container mx-auto p-8 pt-24">
          {children}
        </main>
      </body>
    </html>
  )
}
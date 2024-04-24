import NextAuth from 'next-auth/next'
import CredentialsProvider from "next-auth/providers/credentials"


const handler = NextAuth({
  providers: [
    CredentialsProvider({
      name: 'Credentials',
      credentials: {
        username: { label: "Email", type: "email" },
        password: { label: "Password", type: "password" }
      },
      async authorize(credentials, req) {
        const res = await fetch(new URL('/auth/signin', process.env.API_ENDPOINT), {
          method: 'POST',
          body: JSON.stringify(credentials),
          headers: { 'Content-Type': 'application/json' }
        })

        const user = await res.json()

        if (res.ok) {
          return user
        }

        return null
      },
    })
  ],
})

export {
  handler as GET,
  handler as POST,
}
